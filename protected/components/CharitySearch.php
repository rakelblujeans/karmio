<?php

class CharitySearch extends CComponent
{
    /*  private function log($text)
    {
      Yii::log($text . "\n\n\n\n\n\n");
      Yii::log($text . "\n\n\n\n\n\n", 'error');
    }*/

    # called from ProductController::actionFindCharity()
    public function search($charity, $state, $category, $offset, $type)
    {
        #echo $charity .' - '. $state .' - '. $category . ' - '. $offset . ' _ '. $type;
        $condition = array();
        $condition_str = '';
        if($type != '')
            $condition[] = 'type = "'.$type.'"';
        else
        {
            if($charity != '')
                $condition[] = 'name LIKE "%'.$charity.'%"';
            if($state != '')
                $condition[] = 'state LIKE "%'.$state.'%"';
            if($category != '')
                $condition[] = 'category LIKE "%'.$category.'%"';
        }

        if(count($condition))
            $condition_str = implode(' AND ', array_filter($condition));
        //echo $condition_str;

        $charities = Charities::model()->findAll($condition_str);
        $total =  count($charities);
        $limit = 'LIMIT '.$offset.' 4';

        $charities = Charities::model()->findAll(array('condition' => $condition_str, 'limit' => 4, 'offset' => $offset));

        $first = ($total > 0)?$offset+1:0;
        $upper_limit = ($total > 0)?(($total > 4 )?(($first-1)+4):$total):$total;
        $output = '<div>';
        $output .= '<div class="Pagination">
            <div class="PageResults">';
        $output .= 'Results '.$first.' - '.$upper_limit.' of '.$total.'</div>';
        if($total > 4){
            $output .= '<div class="PageNumbers">';
            $count = 1;
            if($offset > 0)
            {
                $prev = $offset - 4;
                $output .= '<a onClick="getList('.$prev.', \''.$type.'\')" href="javascript:void(-1)">&lt;&lt;</a>';
            }
            for($i=0; $i<$total; $i+=4){

                if($count <=5 )
                {
                    $output .= '<a onClick="getList('.$i.', \''.$type.'\')" href="javascript:void(-1)">'.$count.'</a>';
                }

                $count++;
            }
            if($offset < $total)
            {
                $next = $offset + 4;
                $output .= '<a onClick="getList('.$next.', \''.$type.'\')" href="javascript:void(-1)"> &gt;&gt;</a>';
            }
            $output .= '</li></ul>';
            $output .= '</div>';
        }
        $output .= '<ul class="ResultList">';
        foreach($charities as $val){
            $charity_name = str_replace("'", "\'", $val->name);
            $output .= '<li><p>
							 '.$val->name.' 
							<span>'.$val->city.', '.$val->state.'</span>
							</p>';
            $output .= '<input type="radio" name="charities" value="'.$val->ein.'" onclick="setValue('.$val->ein.',\''.$charity_name.'\')" />';
            $output .= '	</li>';
        }
        $output .= '	</ul></div>';
        return $output;
    }


}