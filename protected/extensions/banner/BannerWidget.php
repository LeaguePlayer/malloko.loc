<?php
class BannerWidget extends CWidget
{
	private $_run = true;
	private $_assetsUrl;
	public $firstBanner;
	public $options = array(
		'duration' => 5000
	);


	public function init()
	{
		if ( $this->firstBanner === null ) {
			$criteria = new CDbCriteria;
			$criteria->addCondition('status=:status and (ISNULL(place_id) OR place_id=0 OR place_id=:place_id)');
			$criteria->params[':status'] = Banners::STATUS_PUBLISH;
			$criteria->params[':place_id'] = $this->owner->place['id'];
			$criteria->order = 'rand()';
			$this->firstBanner = Banners::model()->find($criteria);
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
						newBanner.find('img').load(function() {
							\$this.animate({height: newBanner.height()}, 400);
							oldBanner.fadeOut(200, function() {
								newBanner.fadeIn(200);
								oldBanner.remove();
							});
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
