<?php
/*
 *@author: qinxuening
 *@E-mail: 2423859713@qq.com
 *@date: 2018年12月16日 下午1:33:45
 *三个月前还是
 */
namespace app\admin\controller;
use app\common\controller\baseAdmin;
use think\Db;
use we\Random;


class Addon extends baseAdmin{
    protected $table;
    protected $table_name;
    protected $status;
    protected $excel_title;
    
    public function _initialize()
    {
        parent::_initialize();
        $this->table = Db::name('addon');
        $this->table_name = 'addon';
        $this->status = [
            'status' => ['0'=>'禁用','1'=>'启用'],
        ];
        $this->excel_title = '插件管理报表';
    }
    
    
    public function editAssign() {
        $salt = Random::alnum();
        $addon_key = config('ADDON_KEY');
        $unic_key = sha1(md5($salt).md5($addon_key).time());
        $this->assign('unic_key', $unic_key);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}