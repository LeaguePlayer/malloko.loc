<?php
class BannerWidget extends CWidget
{
	private $_run = true;
	private $_assetsUrl;
	public $firstBanner;
	public $options = array();


	public function init()
	{
		if ( $this->firstBanner === null ) {
			$this->firstBanner = Banners::model()->findByAttributes(array(
				'status' => Banners::STATUS_PUBLISH
			), array('order' => 'rand()'));
			if ( $this->firstBanner === null ) {
				$this->_run = false;
				return true;
			}
		}
		
		$this->options['current'] = $this->firstBanner->id;
		$this->registerScripts();
	}
 
    public function run()
	{
		if ( !$this->_run ) {
			return true;
		}
		$this->render('banner', array('model' => $this->firstBanner));
    }
	
	public function registerScripts() {		
		$options = CJSON::encode($this->options);
		$cs = Yii::app()->clientScript;
		//$cs->registerScriptFile($this->assetsUrl.'/script.js', CClientScript::POS_BEGIN);
		$cs->registerScript(__CLASS__,"
	$.fn.bannerWidget = function(options) {
		return this.each(function() {
			var settings = $.extend({
				duration: 10000,
				url: '/banners/getNext',
				current: 0,
				container: '.banners',
			}, options || {});
			
			\$this = $(this);
			
			setInterval(function() {
				$.ajax({
					url: settings.url,
					type: 'GET',
					data: {
						current: settings.current
					},
					dataType: 'json',
					success: function(data) {
						if ( !data )
							return;
						
						settings.current = data.current;
						var newBanner = $(data.html).hide();
						var oldBanner = \$this.children();
						\$this.append(newBanner);
						\$this.animate({height: newBanner.height()}, 400);
						oldBanner.fadeOut(200, function() {
							newBanner.fadeIn(200);
							oldBanner.remove();
						});
					}
				});
			}, settings.duration);
		});
	};

	$('.banners').bannerWidget(".$options.");");
	}
	
	protected function getAssetsUrl() {
        if ($this->_assetsUrl===null){
            $this->_assetsUrl = Yii::app()->assetManager->publish(dirname(__FILE__).'/assets');
        }
		return $this->_assetsUrl;
    }
}
