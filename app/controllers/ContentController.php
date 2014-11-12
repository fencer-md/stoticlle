<?php

class ContentController extends \BaseController {

	public function showPages () {

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

	public function showBlocks() {

		$blocks = Block::all();

		return View::make('backend.admin.config.blockslist')->with('blocks', $blocks);

	}

	public function editBlock ($bid) {

		$block = Block::where('id', '=', $bid)->first();
		$block->content = json_decode($block->content);

		return View::make('backend.admin.config.blockedit')->with('block', $block);

	}

	public function updateMainBlock() {

		$block = Block::where('title', '=', 'main-block')->first();
		$block->content = json_decode($block->content);
		$block->content->body = Input::get('body');
		$block->content->video_1 = Input::get('video_1');
		$block->content->video_2 = Input::get('video_2');
		$block->content->video_3 = Input::get('video_3');
		$block->content = json_encode($block->content);
		$block->save();

		return Redirect::back();

	}

	public function updateBlocks() {

		$block = Block::where('title', '=', 'block-1')->orWhere('title', '=', 'block-2')->orWhere('title', '=', 'block-3')->first();
		$block->content = json_decode($block->content);
		$block->content->body = Input::get('body');
		$block->content->video_1 = Input::get('video_1');
		$block->content->video_2 = Input::get('video_2');
		$block->content->video_3 = Input::get('video_3');
		$block->content = json_encode($block->content);
		$block->save();

		return Redirect::back();

	}
	
	public function updatePartners() {

		$block = Block::where('title', '=', 'partners')->first();
		$block->content = json_decode($block->content);
		$block->content->partner_1 = base64_encode(file_get_contents(Input::file('partner_1')));
		$block->content->partner_2 = base64_encode(file_get_contents(Input::file('partner_2')));
		$block->content->partner_3 = base64_encode(file_get_contents(Input::file('partner_3')));
		$block->content->partner_4 = base64_encode(file_get_contents(Input::file('partner_4')));
		$block->content->partner_5 = base64_encode(file_get_contents(Input::file('partner_5')));
		$block->content->partner_6 = base64_encode(file_get_contents(Input::file('partner_6')));
		$block->content = json_encode($block->content);
		$block->save();

		return Redirect::back();

	}

}
