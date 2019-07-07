<?php
/*--Menu recursive--*/
class recursive_helper {
    public static function print_recursive($multilevel,$aktif_menu=0) {
        $strmenu = '';
        $aktif=0;

        $count = count($aktif_menu)-1;
        foreach($aktif_menu as $key=>$val){
           $var_menu[]=$aktif_menu[$key]['id'];
        }


        foreach($multilevel as $data){
            $umpan=self::print_recursive($data['child'],$aktif_menu);
            $strmenu .= '
                <li ';

            if (in_array($data['id'],$var_menu)){
                if($data['id']==$aktif_menu[$count]['id']){
                    $strmenu .= 'class="active"';
                    $aktif =1;
                }else{
                    $strmenu .= 'class="active open"';
                }
            }

            // $strmenu .= '>
            //         <a href="'.$data['part'].'" class="';
            $strmenu .= '>
                    <a href="'.url($data['part']).'" class="';
            if ($umpan)$strmenu .='dropdown-toggle';
            $strmenu .= '">
                        <i class="menu-icon fa ';

                if ($data['icon'])$strmenu .= $data['icon']; else $strmenu .= 'fa-caret-right';

            $strmenu .='"></i>';


            if ($data['parent']==0)$strmenu .='<span class="menu-text"> '.$data['nama'].' </span>';else $strmenu .= $data['nama'];



            if ($umpan)$strmenu .= '<b class="arrow fa fa-angle-down"></b>';

            $strmenu .= '</a>';

            $strmenu .='<b class="arrow"></b>';
            if ($umpan)$strmenu .='<ul class="submenu">'.$umpan.'</ul>';

            $strmenu .='</li>';
        }
//        return $strmenu;
        return $strmenu;
    }

    public static function aktif_menu($aktif_menu) {
        $strmenu = "";

        foreach($aktif_menu as $data){
            if (self::aktif_menu($data['child']))$strmenu .='';else$strmenu .=',';

            if ($page==$data['nama'])return $strmenu;
            $strmenu .= $data['nama'];

            if (self::aktif_menu($data['child'])){
               $strmenu .=self::aktif_menu($data['child']);
            } else {

            }

            $strmenu .='</li>';
        }
        return $strmenu;
    }

    public static function print_aktifmenu($aktif_menu,$page) {
        $strmenu = "";

        foreach($aktif_menu as $data){
            $strmenu .= '<li>'.$data['nama'].'';

            if ($page==$data['nama'])return $strmenu;

            if (self::print_aktifmenu($data['child'],$page)){
               $strmenu .=self::print_aktifmenu($data['child'],$page).'';
            }

            $strmenu .='</li>';
        }
        return $strmenu;
    }

}
