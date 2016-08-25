<?php

namespace Nht\Http\Controllers\admin;

use Illuminate\Http\Request;

use Nht\Http\Requests;

use Nht\Http\Controllers\Admin\AdminController;
use Nht\Http\Controllers\Controller;

use Nht\Http\Requests\AdminTagFormRequest;
use Nht\Hocs\Tags\Tag;
use Nht\Hocs\Tags\TagRepository;

use App;


class TagController extends AdminController
{
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        parent::__construct();
        $this->tag   = $tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tags = $this->tag->getPaginated(20, [], $request->all(), $this->getSortArray($request));
        $positions = getTagPositions();
        return view('admin/tags/index', compact('tags', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $positions = getTagPositions();
        return view('admin/tags/create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AdminTagFormRequest $request)
    {
        $formData = $request->except('_token', 'position');

        if($tag = $this->tag->create($formData)) {
            $this->tag->savePositions($tag, $request->get('position', []));
            return redirect()->back()->with('success', trans('general.messages.create_success'));
        }

        return redirect()->back()->with('success', trans('general.messages.create_fail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->tag->getById($id);
        $positions = getTagPositions();
        $oldTagPositions = $this->tag->getPositions($tag);
        return view('admin/tags/edit', compact('tag', 'positions', 'oldTagPositions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $tag = $this->tag->getById($id);
        $formData = $request->except('_token', 'position');
        // _debug($request->get('position'));die;

        if($this->tag->update($formData, ['id' => $id])) {
            $this->tag->savePositions($tag, $request->get('position', []));
            return redirect()->route('admin.tag.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.tag.index')->with('error', trans('general.messages.update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $tag = $this->tag->getById($id);

        if($tag->delete()) {
            return redirect()->back()->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->back()->with('error', trans('general.messages.delete_fail'));
    }


    public function active($id) {
        $tag = $this->tag->getById($id);

        $tag->status = !$tag->status;

        if($tag->save()) {
            return response()->json([
               'code' => 1,
               'status' => $tag->getStatus()
            ]);
        }

        return response()->json([
           'code' => 0
        ]);
    }


    public function getSortArray(Request $request) {
        return ['updated_at' => 'DESC'];
    }


    public function ajaxTag(Request $request)
    {
        $q = $request->get('q');
        $tags = $this->tag->searchTagByNamePaginated($q);
        $json = [];
        foreach($tags as $tag) {
            $json[] = [
                'id' => $tag->getId(),
                'name' => $tag->getName()
            ];
        }

        return response()->json($json);
    }
}
