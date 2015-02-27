<?php namespace Blog\Functions\Posts;

class PostsFunctions {

	public function __construct()
	{
	}

	public function linkifyContent($content)
	{
		//	Convert Twitter Content
		$content = $this->convertTwitterContent($content);

		return $content;
	}

	private function convertTwitterContent($content)
	{
		//	Convert hashtags to twitter searches in <a> links
		$content = preg_replace("/#([A-Za-z0-9\_\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $content);

		//	Convert @tags to twitter profiles in <a> links
		$content = preg_replace("/@([A-Za-z0-9\_\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $content);

		return $content;
	}

	public function removeLinks($content)
	{
		return preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $content);
	}

}