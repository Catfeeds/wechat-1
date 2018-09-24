<?php
/**
* @author: qxn
* @E-mial: 2423859713@qq.com
* @date: 2018年9月21日 上午10:31:54
*/
namespace app\admin\controller\auth;

use app\common\controller\baseAdmin;
use think\Db;
use we\Tree;

class Rule extends baseAdmin{
    protected $rulelist;
    
    public function _initialize(){
        parent::_initialize();
        // 必须将结果集转换为数组
        $ruleList = Db::name('auth_rule')->order('weigh', 'desc')->select();
        foreach ($ruleList as $k => &$v)
        {
            $v['title'] = __($v['title']);
            $v['remark'] = __($v['remark']);
        }
        unset($v);
        Tree::instance()->init($ruleList);
        $this->rulelist = Tree::instance()->getTreeList(Tree::instance()->getTreeArray(0), 'title');
        $ruledata = [0 => __('None')];
        foreach ($this->rulelist as $k => &$v)
        {
            if (!$v['ismenu'])
                continue;
            $ruledata[$v['id']] = $v['title'];
        }
        $this->view->assign('ruledata', $ruledata);
    }
    
    /**
     * 规则管理
     * @return string
     */
    public function index() {
        return $this->view->fetch();
    }
    
    public function getRule($page = 0, $limit = 10) {
        $this->rulelist = Db::name('auth_rule')
            ->order('weigh', 'desc')
            ->page($page,$limit)
            ->select();
        $count = Db::name('auth_rule')->count('*');
        return json(['code' => 0, 'count' => $count, 'data' => $this->rulelist,'msg' => '获取成功']);
    }
    
    public function view() {
         $id = intval(input('id'));
         $list = Db::name('auth_rule')->where(['id' => $id])->find();
         $this->assign('list', $list);
         return $this->view->fetch();
    }
    
    
    public function edit() {
        $id = intval(input('id'));
        if(request()->isAjax()){
            $id = input('id');
            $data = input('');
            $data['status'] = $data['status'] == 'on' ? '1' : 0;
            $data['ismenu'] = $data['ismenu'] == 'on' ? '1' : 0;
            if($id){
                Db::name('auth_rule')->where(['id' => $id])->update($data);
                return json(['code' => 1, 'status' => 'success', 'info' => '操作成功']);
            } else {
                return json(['code' => -1, 'status' => 'error', 'info' => '非法操作']);
            }
        }
        $list = Db::name('auth_rule')->where(['id' => $id])->find();
        $this->assign('list', $list);
        return $this->view->fetch();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}