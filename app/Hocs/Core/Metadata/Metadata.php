<?php
namespace Nht\Hocs\Core\Metadata;

use Nht\Hocs\Settings\Setting;
use Nht\Hocs\Settings\SettingRepository;

class Metadata {

	public function __construct(SettingRepository $set) {
		if($setting = $set->find(1)) {
			$dbSetting = \DB::select('SHOW FIELDS FROM settings');
			foreach ($dbSetting as $set) {
				$field        = $set->Field;
				$this->$field = $setting->$field;
			}
		}
	}

	public function setTitle($title) {
		return $this->name = $title;
	}

	public function getTitle() {
		return $this->name;
	}

	public function setLogo($logo) {
		return $this->logo = $logo;
	}

	public function getLogo() {
		return $this->logo;
	}

	public function setAddress($address) {
		return $this->address = $address;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setEmail_1($email) {
		return $this->email_1 = $email;
	}

	public function getEmail_1() {
		return $this->email_1;
	}

	public function setPhone_1($phone) {
		return $this->phone_1 = $phone;
	}

	public function getPhone_1() {
		return $this->phone_1;
	}

	public function setSkype_1($skype) {
		return $this->skype_1 = $skype;
	}

	public function getSkype_1() {
		return $this->skype_1;
	}

	public function setShortDescription($description) {
		return $this->short_description = $description;
	}

	public function getShortDescription() {
		return $this->short_description;
	}

	public function setDescription($description) {
		return $this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setContact($contact) {
		return $this->contact = $contact;
	}

	public function getContact() {
		return $this->contact;
	}

	public function setMetaTitle($meta_title) {
		return $this->meta_title = $meta_title;
	}

	public function getMetaTitle() {
		return $this->meta_title;
	}

	public function setMetaKeyword($meta_keyword) {
		return $this->meta_keyword = $meta_keyword;
	}

	public function getMetaKeyword() {
		return $this->meta_keyword;
	}

	public function setMetaDescription($meta_description) {
		return $this->meta_description = $meta_description;
	}

	public function getMetaDescription() {
		return $this->meta_description;
	}

	public function setJsCodes($js_codes) {
		return $this->js_codes = $js_codes;
	}

	public function getJsCodes() {
		return $this->js_codes;
	}

	public function setFacebook($facebook) {
		return $this->facebook = $facebook;
	}

	public function getFacebook() {
		return $this->facebook;
	}

	public function setGoogleplus($googleplus) {
		return $this->googleplus = $googleplus;
	}

	public function getGoogleplus() {
		return $this->googleplus;
	}

	public function setTwitter($twitter) {
		return $this->twitter = $twitter;
	}

	public function getTwitter() {
		return $this->twitter;
	}

	public function setLinkin($linkin) {
		return $this->linkin = $linkin;
	}

	public function getLinkin() {
		return $this->linkin;
	}

	public function setYoutube($youtube) {
		return $this->youtube = $youtube;
	}

	public function getYoutube() {
		return $this->youtube;
	}

	public function getLinkStream() {
		return $this->link_stream;
	}
}