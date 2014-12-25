<?php
/*留言评论模块*/
namespace Home\Controller;
use Home\Model\CommentModel;
use Think\Controller;
class CommentController extends CommonController {
	
	/**
	 * 发表留言
	 **/
	public function add(){
		$result = array('code' => -1, 'msg' => '');
        $model = new CommentModel();
        $data = $model->create();
        $data['content'] = $_REQUEST['content'];
        $data['content'] = $this->stripContent($data['content']);

        if(true === $model->insert($data)){
            if (false === getUserInfo()) {
                $userInfo = array(
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'website' => $data['website']
                );
                setUserInfo($userInfo);
            }
			$result['code'] = 0;
		}else{
			$result['msg'] = '发表失败！';
		}
        $this->jsonReturn($result);
	}

    /**
     * strip <script> html tag
     * @param $content | string
     * @return string
     */
    private function stripContent($content) {
        $content = preg_replace("/\<script(.*?)>(.*?)\<\/script\>/", '&lt;script${1}&gt;${2}&lt;/script&gt;', $content);

        //$content = preg_replace("<script(.*?)>(.*?)</script>", '&lt;script${1}&gt;${2}&lt;/script&gt;', $content);
        return $content;
    }


}
