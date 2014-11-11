<?php

class ContentController extends \BaseController {

	public function show () {

		$pages = Page::all();

		return View::make('backend.admin.config.pageslist')->with('pages', $pages);

	}

	public function edit ($pid) {

		$page = Page::where('id', '=', $pid)->first();

		return View::make('backend.admin.config.pageedit')->with('page', $page);

	}

	public function update () {

		$page = Page::where('id', '=', Input::get('pid'))->first();
		
		$page->title = Input::get('title');
		$page->body = Input::get('body');
		$page->save();

		return Redirect::back();

	}

	public function viewMake ($ptitle) {

		$ptitle = str_replace('_', ' ', $ptitle);
		$page = Page::where('title', '=', $ptitle)->first();

		return View::make('frontend.pages')->with('page', $page);

	}

	public function editBlock

}
