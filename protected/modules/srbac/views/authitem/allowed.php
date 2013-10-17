<?php
/**
 * allowed.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The view for the editing of the alwaysAllowed list
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem
 * @since 1.1.0
 */
?>
<?php

//CVarDumper::dump($controllers, 3, true);
foreach ($controllers as $n=>$controller) {
  $title = $controller["title"];
  $data = array();
  foreach ($controller["actions"] as $key=>$val) {
    $data[$val] = $val;
  }
  if(sizeof($data) > 0) {
    $select = $controller["allowed"];
    // It seems that this tabview conflicts with assign tabview so I raise the tab number by 3
    //$cont[$n+3]["title"] = str_replace("Controller", "", $title);
    //$cont[$n+3]["content"] = SHtml::checkBoxList($title, $select, $data);


    $cont["tab_".$n] = array(
      "title"=>str_replace("Controller", "", $title),
      "content"=>SHtml::checkBoxList($title, $select, $data));
  }
}
?>
<?php echo SHtml::form();?>
<div class="vertTab">
  <?php
  Helper::publishCss($this->module->css);
  $this->widget('system.web.widgets.CTabView',
    array(
    'tabs'=>$cont,
    'cssFile'=>$this->module->getCssUrl(),
  ));
  ?>
</div>
<div class="action">
  <?php echo SHtml::ajaxSubmitButton(Helper::translate("srbac", "Save"),
  array('saveAllowed'),
  array(
  'type'=>'POST',
  'update'=>'#wizard',
  'beforeSend' => 'function(){
    $("#wizard").addClass("srbacLoading");
    }',
  'complete' => 'function(){
    $("#wizard").removeClass("srbacLoading");
    }',
  ),
  array(
  'name'=>'buttonSave',
  )
  )
  ?>
</div>
<?php echo SHtml::endForm();?>
<!--Adjust tabview height--->
<script type="text/javascript">
  var tabsHeight = $(".tabs").height();
  if(tabsHeight > 260){
    $(".view").height(tabsHeight-16);
  } else {
    $(".view").height(260);
    $(".tabs").attr("style","border-bottom:none");
    
  }
  (function($) {

	$.extend($.fn, {
		yiitab: function() {

			function activate(id) {
				var pos = id.indexOf("#");
				if (pos>=0) {
					id = id.substring(pos);
				}
				var $tab=$(id);
				var $container=$tab.parent();
				$container.find('>ul a').removeClass('active');
				$container.find('>ul a[href="'+id+'"]').addClass('active');
				$container.children('div').hide();
				$tab.show();
			}

			this.find('>ul a').click(function(event) {
				var href=$(this).attr('href');
				var pos=href.indexOf('#');
				activate(href);
				if(pos==0 || (pos>0 && (window.location.pathname=='' || window.location.pathname==href.substring(0,pos))))
					return false;
			});

			// activate a tab based on the current anchor
			var url = decodeURI(window.location);
			var pos = url.indexOf("#");
			if (pos >= 0) {
				var id = url.substring(pos);
				if (this.find('>ul a[href="'+id+'"]').length > 0) {
					activate(id);
					return;
				}
			}
		}
	});

})(jQuery);
</script>
