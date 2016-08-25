<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Requests\AdminSiteFormRequest;
use Nht\Http\Requests\AdminAddLinkFormRequest;
use Nht\Http\Requests\AdminSiteImportRequest;

use Nht\Http\Controllers\Admin\AdminController;

use Nht\Hocs\Sites\Site;
use Nht\Hocs\Sites\Meta as SiteMeta;
use Nht\Hocs\Sites\Link as SiteLink;
use Nht\Hocs\Sites\SiteRepository;
use Nht\Hocs\Sites\SiteCreator;
use Nht\Hocs\Sites\SiteCreatorListener;
use Nht\Hocs\Sites\SiteUpdater;
use Nht\Hocs\Sites\SiteUpdaterListener;
use Nht\Hocs\Sites\SiteDeleter;
use Nht\Hocs\Sites\SiteDeleterListener;

use Nht\Hocs\Brands\BrandRepository;

use Storage, Excel;

class SiteController extends AdminController implements SiteCreatorListener, SiteUpdaterListener, SiteDeleterListener
{

    public function __construct(SiteRepository $site, SiteCreator $creator, SiteUpdater $updater, SiteDeleter $deleter,
        BrandRepository $brands)
    {
        parent::__construct();
        $this->site    = $site;
        $this->creator = $creator;
        $this->updater = $updater;
        $this->deleter = $deleter;
        $this->brands  = $brands;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {

        $sortOptions = [
            1 => 'Link desc',
            2 => 'Link asc'
        ];

        $allowCrawlOptions = [
            -1 => 'Tất cả',
            0  => 'Không cho phép',
            1  => 'Cho phép'
        ];

        $sites = $this->site->getPaginated(20, [], $request->all(), $this->getSortParams($request));

        return view('admin/sites/index', compact('sites', 'sortOptions', 'allowCrawlOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $sites = $this->site->getAllParents();
        return view('admin/sites/create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postCreate(AdminSiteFormRequest $request)
    {
        return $this->creator->createSite($this, $request->all());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $site = $this->site->getById($id);
        $sites = $this->site->getAllParents();
        return view('admin/sites/edit', compact('site', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id, Request $request)
    {
        $site = $this->site->getById($id);
        return $this->updater->updateSite($this, $site, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $site = $this->site->getById($id);
        return $this->deleter->deleteSite($this, $site);
    }

    public function getRank(Request $request) {

        $sites = $this->site->getAll();

        $dataUpdate = [];

        foreach($sites as $site) {
            $url  = 'http://data.alexa.com/data?cli=10&url=' . $site->getName();
            $xml  = json_encode(simplexml_load_file($url));
            $xml = json_decode($xml, true);

            $rank = isset($xml['SD']['COUNTRY']) ? $xml['SD']['COUNTRY']['@attributes']['RANK'] : 0;

            $dataUpdate[$site->getId()] = [
                // 'name' => $site->getName(),
                'alexa_rank_vn' => $rank
            ];
        }

        foreach($dataUpdate as $id => $data) {
            \DB::table('sites')->where('id', $id)->update($data);
        }

        return redirect()->route('admin.site.index')->with('success', 'Cập nhật thành công');
    }

    public function getSync()
    {
        // \DB::table('sites')->truncate();
        // \DB::statement('INSERT into sites(name, created_at, updated_at) SELECT DISTINCT(`source`), now(), now() from product_prices');

        $sites = \DB::table('product_prices')->select(\DB::raw(' DISTINCT(`source`)'))->get();
        $dataInsert = [];
        foreach($sites as $site) {
            if(\DB::table('sites')->where('name', $site->source)->count() == 0) {
                $dataInsert[] = [
                    'name'       => $site->source,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }

        if($dataInsert) {
            \DB::table('sites')->insert($dataInsert);
        }

        return redirect()->route('admin.site.index')->with('success', 'Cập nhật thành công');
    }


    /**
     * Xpath listing
     */
    public function getXpath(Request $request, $siteId) {
        $site  = $this->site->getById($siteId);
        $xpaths = $this->site->getAllXpathBySite($site);
        return view('admin/sites/xpath/index', compact('site', 'xpaths'));
    }

    /**
     * Create xpath form
     */
    public function getCreateXpath(Request $request, $siteId)
    {
        $site  = $this->site->getById($siteId);
        $xpath = new SiteMeta;
        $typeXpaths = [
            0 => 'HTML',
            1 => 'Json HTML',
            2 => 'Json'
        ];
        return view('admin/sites/xpath/create', compact('site', 'xpath', 'typeXpaths'));
    }

    /**
     * Create xpath
     */
    public function postXpath(Request $request, $siteId) {
        $site  = $this->site->getById($siteId);

        $data = $request->except(['_token']);

        $xpathId = \DB::table('site_metas')->insertGetId($data);

        $xpath = $this->site->getXpathById($xpathId);

        // return redirect()->route('admin.site.xpath', [$site->getId()])->with('success', 'Thành công');
        return response()->json(['code' => 1, 'message' => 'Thành công', 'data' => $xpath]);
    }


    /**
     * Edit xpath form
     */
    public function getEditXpath(Request $request, $xpathId)
    {
        $xpath = $this->site->getXpathById($xpathId);
        $site  = $this->site->getById($xpath->getSiteId());

        $typeXpaths = [
            0 => 'HTML',
            1 => 'Json HTML',
            2 => 'Json'
        ];

        return view('admin/sites/xpath/edit', compact('xpath', 'site', 'typeXpaths'));
    }

    /**
     * Update xpath action
     */
    public function postEditXpath(Request $request, $xpathId)
    {
        $xpath = $this->site->getXpathById($xpathId);
        $data  = $request->except(['_token']);
        $data['is_json'] = (int) $request->get('is_json');

        if($this->site->updateXpath($xpathId, $data) >= 0) {
            return redirect()->route('admin.site.xpath', [$xpath->getSiteId()])->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    /**
     * Delete xpath action
     */
    public function getDeleteXpath(Request $request, $xpathId) {
        $xpath = $this->site->getXpathById($xpathId);
        if($xpath->delete()) {
            return redirect()->back()->with('success', 'Xóa xpath thành công');
        }

        return redirect()->back()->with('error', 'Xóa xpath không thành công');
    }


    /**
     * Link listing
     */
    public function getLinksIndex(Request $request, $siteId)
    {
        $site  = $this->site->getById($siteId);
        $links = $this->site->getXpathLink($siteId, $request->input());

        foreach ($links as $value) {
            $brands[] = $value->brands()->first();
        }

        // Brands editable
        $brandEdiables = [];
        foreach($this->brands->getAll() as $brand) {
            $brandEdiables[] = [
                'value' => $brand->getId(),
                'text' => $brand->getName()
            ];
        }

        $brandEdiables = json_encode($brandEdiables, JSON_UNESCAPED_UNICODE);

        // Xpath editable
        $xpathEdiables = [];
        foreach($this->site->getAllXpathBySite($site) as $xpath) {
            $xpathEdiables[] = [
                'value' => $xpath->getId(),
                'text'  => $xpath->getXpathLinkDetail()
            ];
        }

        $xpathEdiables = json_encode($xpathEdiables, JSON_UNESCAPED_UNICODE);

        return view('admin/sites/link/index', compact('site', 'links', 'brands', 'brandEdiables', 'xpathEdiables'));
    }


    /**
     * Create link form
     */
    public function getLinks(Request $request, $siteId) {
        $site   = $this->site->getById($siteId);
        $xpaths  = $site->meta()->get();

        $brands = $this->brands->getAllBrands();

        $typeXpaths = [
            0 => 'HTML',
            1 => 'Json HTML',
            2 => 'Json'
        ];

        return view('admin/sites/link/create', compact('site', 'brands', 'xpaths', 'typeXpaths'));
    }

    /**
     * Create link action
     */
    public function postLinks(AdminAddLinkFormRequest $request, $siteId)
    {
        $site   = $this->site->getById($siteId);
        $result = $this->site->saveXpathLink($siteId, $request->except(['_token']));

        return redirect()->route('admin.site.links.index', $site->id)->with('success', 'Thành công');
    }


    /**
     * Edit link form
     */
    public function getEditLink(Request $request, $siteId, $linkId) {

        $link = $this->site->getLinkById($linkId);
        $brands = $this->brands->getAllBrands();

        $site   = $this->site->getById($siteId);
        $xpaths  = $site->meta()->get();

        $typeXpaths = [
            0 => 'HTML',
            1 => 'Json HTML',
            2 => 'Json'
        ];

        return view('admin/sites/link/edit', compact('site', 'link', 'brands', 'xpaths', 'typeXpaths'));
    }

    /**
     * Edit link action
     */
    public function postEditLink(AdminAddLinkFormRequest $request, $siteId, $linkId)
    {
        $site = $this->site->getById($siteId);
        $this->site->updateXpathLink($linkId, $request->except(['_token']));

        // _debug($request->all());die;

        return redirect()->route('admin.site.links.index', $site->id)->with('success', 'Cập nhật thành công');
    }

    /**
     * Quick edit link
     */
    public function putQuickEditLink(Request $request)
    {
        $id    = $request->get('id');
        $field = $request->get('field');
        $value = $request->get('value');

        if($this->site->quickEditLink($id, $field, $value)) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }

    /**
     * Delete link action
     */
    public function getDeleteLink(Request $request, $siteId, $linkId) {
        $site = $this->site->getById($siteId);
        $link = $this->site->getLinkById($linkId);
        $link->delete();

        return redirect()->route('admin.site.links.index', [$siteId])->with('success', 'Cập nhật thành công');
    }


    /**
     * Set cronjob form
     */
    public function getSiteCronjob(Request $request, $siteId)
    {
        $site = $this->site->getById($siteId);
        $cronjob = $site->cronjob()->get();

        $cron = [];
        foreach ($cronjob as $value) {
            $cron[] = $value->day;
        }

        return view('admin/sites/cronjob', compact('site', 'cron'));
    }


    /**
     * Site cronjob action
     */
    public function postSiteCronjob(Request $request, $siteId)
    {
        $site = $this->site->getById($siteId);
        $this->site->saveCronjobTime($siteId, $request->input('day', []));

        return redirect()->route('admin.site.index')->with('success', 'Cập nhật thành công');
    }

    public function postImportXpath(AdminSiteImportRequest $request)
    {
        if ($request->file('import-xpath')->isValid()) {
            $file = $request->file('import-xpath');
            $path = public_path()."/uploads/sites";

            if ( !Storage::directories($path) ) {
                Storage::makeDirectory($path);
            }

            $file->move($path, 'xpath_site.xlsx');


            $result = Excel::load(public_path()."/uploads/sites/xpath_site.xlsx", function() {

            })->get()->toArray();

            $this->site->importExcelXpath($result);

            return redirect()->route('admin.site.index')->with('success', 'Cập nhật thành công');
        }

    }

    public function postImportLink(AdminSiteImportRequest $request, $siteId)
    {
        $site = $this->site->getById($siteId);

        if ($request->file('import-link')->isValid()) {
            $file = $request->file('import-link');
            $path = public_path()."/uploads/sites";

            if ( !Storage::directories($path) ) {
                Storage::makeDirectory($path);
            }

            $file->move($path, 'xpath_link.xlsx');
            $result = Excel::load(public_path()."/uploads/sites/xpath_link.xlsx", function() {

            })->get()->toArray();

            $this->site->importExcelLink($siteId ,$result);

            return redirect()->route('admin.site.links.index', $site->getId())->with('success', 'Cập nhật thành công');
        }

    }

    /**
     * Toggle hot action
     */
    public function getHot(Request $request, $id)
    {
        $site = $this->site->getById($id);
        $site->hot = !$site->hot;
        if($site->save()) {
            return response()->json(['code' => 1, 'status' => $site->hot]);
        }

        return response()->json(['code' => 0]);
    }


    /**
     * Toggle env testing
     */
    public function toggleEnvTesting($id)
    {
        $site = $this->site->getById($id);

        // Rest all sites env to no testing
        $this->site->resetEnvTesting();

        // Set this site to env testing
        $site->env_testing = !$site->env_testing;
        if($site->save()) {
            return response()->json(['code' => 1, 'status' => $site->env_testing]);
        }

        return response()->json(['code' => 0]);
    }


    public function toggleEnvQuick($id)
    {
        $site = $this->site->getById($id);

        // Rest all sites env to no quick
        $this->site->resetEnvQuick();

        // Set this site to env quick
        $site->env_quick = !$site->env_quick;
        if($site->save()) {
            return response()->json(['code' => 1, 'status' => $site->env_quick]);
        }

        return response()->json(['code' => 0]);
    }


    public function toggleAllowCrawl($id)
    {
        $site = $this->site->getById($id);


        // Set this site to env quick
        $site->allow_crawl = !$site->allow_crawl;
        if($site->save()) {
            return response()->json(['code' => 1, 'status' => $site->allow_crawl]);
        }

        return response()->json(['code' => 0]);
    }


    public function getSortParams(Request $request)
    {
        $sort = [];
        if($request->get('sort') == 1) {
            $sort['total_links'] = 'desc';
        } else if($request->get('sort') == 2) {
            $sort['total_links'] = 'asc';
        }

        return $sort;
    }


    public function updateTotalLinks()
    {
        $this->site->updateTotalLinks();
        return redirect()->route('admin.site.index')->with('success', ' Cập nhật thành công');
    }


    public function getBranchCreate($siteId, Request $request)
    {
        $site = $this->site->getById($siteId);
        $isBranchForm = true;
        $sites = $this->site->getAllParents();
        return view('admin/sites/create', compact('site', 'isBranchForm', 'sites'));
    }

    public function postBranchCreate($siteId, Request $request)
    {
        $data = $request->all();
        $data['parent_id'] = $siteId;
        return $this->creator->createSite($this, $data);
    }

    public function creationSuccess(Site $site)
    {
        return redirect()->route('admin.site.index')->with('success', 'Tạo site thành công');
    }

    public function creationFailed()
    {
        return redirect()->back()->withInputs()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
    }

    public function updationSuccess(Site $site)
    {
        return redirect()->route('admin.site.index')->with('success', 'Cập nhật site thành công');
    }

    public function updationFailed()
    {
        return redirect()->back()->withInputs()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
    }

    public function deletionSuccess(Site $site) {
        return redirect()->route('admin.site.index')->with('success', 'Xóa thành công '. $site->getName() .'');
    }

    public function deletionFailed() {
        return redirect()->route('admin.site.index')->with('error', 'Xóa site không thành công');
    }
}
