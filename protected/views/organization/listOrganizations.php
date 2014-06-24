<?php //$this->beginContent('//layouts/fbox');
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
 ?>
<br style="clear:both" />

<div class="non-profit">
 <div class="non-profit-top"></div>
  <div class="non-profit-area">
   <div class="profit-search">
    <div class="p-search">
      <form action="#" name="" method="post">
       <input type="text" name="" class="search-field" value="CHOOSE A NON PROFIT" onfocus="if(this.value=='CHOOSE A NON PROFIT')this.value='';" onblur="if(this.value=='')this.value='CHOOSE A NON PROFIT';" />
       <input type="submit" name="" class="search-buttom" value="" />
      </form>
    </div>
   </div>
   <br style="clear:both" />
   <div class="non-profit-images" id="gallery">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_listOrganizations',
)); ?>
   </div>
  </div>
 <div class="non-profit-bottom"></div>
</div>
