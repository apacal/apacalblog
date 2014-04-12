<?php
        	
namespace Addons\Library\Model;
use Home\Model\WeixinModel;
        	
/**
 * Library的微信模型
 */
class WeixinAddonModel extends WeixinModel{
    public $error = "请输入图书+图书名，忽视空格";
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'Library' ); // 获取后台插件的配置参数	
        $book = $dataArr['Content'];
        $book = str_replace(array('图书', ' '), '', $book);
        if($book == '') {
		    $this->replyText($this->error);
        }else{
            //组装用户在微信里点击图文的时跳转URL
            //其中token和openid这两个参数一定要传，否则程序不知道是哪个微信用户进入了系统
            $param ['id'] = $info ['id'];
            $param ['token'] = get_token ();
            $param ['openid'] = get_openid ();

            $reply = $this->getBook($book);
            if(empty($reply)) {
                $reply = '没有查询到相关信息';
		        $this->replyText($reply);
                return true;
            }
		    //$res = $this->replyNews ( $reply );
		    $this->replyText($reply);
		    //$this->replyText($book);
        }
		//dump($config);

	} 
    public function getBook($book = "LINUX") {
        $model = new SCNULib();
        $list = $model->start($book);
   //     var_dump($list);
        if(empty($list))
            return false;
        $str = '';
        foreach($list as $val) {
            $val[1] = mb_convert_encoding($val[1] , "utf-8", 'HTML-ENTITIES');
            $val[2] = mb_convert_encoding($val[2] , "utf-8", 'HTML-ENTITIES');
            $str .= "【$val[0]-$val[1]】\n \t编者：$val[2]\n";
            foreach($val['subInfo'] as $value) {
                $str .= "\t【$value[0] - $value[4] - $value[5]】\n";
            }
            $str .= "\t \n";
        }
        return $str;
    }
    // 图文
    public function getPicBook($book = "LINUX") {
        $model = new SCNULib();
       // return 'apacal';
        $list = $model->start($book);
   //     var_dump($list);
        if(empty($list))
            return false;
        $i = 0;
        $article = array();
        foreach($list as $val) {
            $i ++;

            $str = '';
            $url = addons_url ( 'Vote://Vote/show', $param );
            $val[1] = mb_convert_encoding($val[1] , "utf-8", 'HTML-ENTITIES');
            $val[2] = mb_convert_encoding($val[2] , "utf-8", 'HTML-ENTITIES');
            foreach($val['subInfo'] as $value) {
                $str = "  [$value[0] - $value[4] - $value[5]]";
            }
            $article[] = array(
                'Title' => "1【$val[1]】-$val[2]",
                'Descrition' => $str,
                'PicUrl' => "218.244.140.70/weixin/favicon.ico",
                'Url' =>addons_url('Library::Liarary/show'),
            );
            if ($i >= 5)
                break;
            
        }
        return $article;
    }

	// 关注公众号事件
	public function subscribe() {
		return true;
	}
	
	// 取消关注公众号事件
	public function unsubscribe() {
		return true;
	}
	
	// 扫描带参数二维码事件
	public function scan() {
		return true;
	}
	
	// 上报地理位置事件
	public function location() {
		return true;
	}
	
	// 自定义菜单事件
	public function click() {
		return true;
	}	
}

        	
/**
 * SCNULib类，使用方法，new SCNULib()->start("Linux");
 **/

class SCNULib {
    public $limit = 4;
    public function start($book = 'Linux') {
        $book = urlencode($book);
        $url = "http://202.116.41.246:8080/opac/openlink.php?strSearchType=title&historyCount=1&strText=".$book."&x=7&y=15&doctype=ALL&match_flag=forward&displaypg=20&sort=CATA_DATE&orderby=desc&showmode=table&dept=ALL";
        $result = $this->getLib($url);
        //$result = html_entity_decode($result);
       // echo mb_convert_encoding($result , "utf-8", 'HTML-ENTITIES');
        //$result = $this->getBookListArray($result);
       // $content = $this->getTable($result);
        $list = $this->getTrArray($result);
        if(empty($list))  //没有信息
            return false;
        $list = $this->removeFirst($list);
        $list = $this->getTdUrlArray($list);
        //$list = $this->getTdArray($list);
        foreach($list as &$value) {
            $this->moveTags($value);
        }
        $this->getAllBookInfo2($list);//馆藏信息
        return $list;

    }
    /**
     * 根据地URL去获取进一步的馆藏信息
     **/
    private function getAllBookInfo2(&$result) {
        foreach($result as &$val) {
            $val['subInfo'] = $this->getBookInfo2($val['url']);
        }
    }
    /**
     * 根据地URL去获取进一步的馆藏信息
     **/
    private function getBookInfo2($url) {
        $content = $this->getLib($url);
        $content = $this->getTable($content);
        $list = $this->getTrArray($content);
        $list = $this->removeFirst($list);
        $list = $this->getTdArray($list);
        foreach($list as &$value) {
            $this->moveTags($value);
        }
        //var_dump($list);
        return $list;//存储索引号，地址等
    }
    /**
     * 去掉第一个数组，是栏目
     **/
    private function removeFirst($list) {
        $rlist = array();
        foreach($list as $key => $val) {
            if($key != 0)
                $rlist[] = $val;
        }
        return $rlist;
    }
    /**
     * 分离table标签
     * @param $Str  包含table标签的html,
     * @return table标签的数组
     **/
    private function getTable($str) {
        $pat = '/<table[^{]*?>[^{]*?<\/table>/is';
        preg_match($pat, $str, $out);
        return $out[0];
    }
    /**
     * 得到tr标签array,分离tr标签
     * @param $Str  包含tr标签的html,最好传入一个table标签
     * @return tr标签的数组
     **/
    private function getTrArray($Str) {
        $pat = '/<tr[^{]*?>[^{]*?<\/tr>/is';
        preg_match_all($pat, $Str, $out); // table
        return $out[0];

    }
    /**
     * 得到td标签array,分离td标签
     * @param $arrayStr 一维字符数组,每个tr标签为一个字符串,将该串的td标签匹配成一维数组
     * @return $list td标签的数组，
     **/
    private function getTdArray($arrayStr) {
        $list = array();
        $pat = '/<td[^{]*?>[^{]*?<\/td>/is';
        foreach ($arrayStr as &$value) {
            preg_match_all($pat, $value, $match); 
            $list[] = $match[0];
        }
        return $list;

    }
    /**
     * 得到td标签array,分离td标签,URL
     * @param $arrayStr 一维字符数组,每个tr标签为一个字符串,将该串的td标签匹配成一维数组
     * @return $list td标签的数组，
     **/
    private function getTdUrlArray($arrayStr) {
        $i = 0;//计数，否则超时
        $list = array();
        $pat = '/<td[^{]*?>[^{]*?<\/td>/is';
        foreach ($arrayStr as &$value) {
            $i ++;
            preg_match_all($pat, $value, $match); 
            $match[0]['url'] = 'http://202.116.41.246:8080/opac/' .$this->getBookUrl($value);
            $list[] = $match[0];
            if($i >= $this->limit)
                break;
        }
        return $list;

    }
    /**
     * 获取图书url，
     * @param $tring 包含url的字符串,只能有一个a标签
     **/
    private function getBookUrl($string) {
        $pattern = '/href="[^{]*?"/is';
        preg_match($pattern, $string, $url);
        $search = array('href=','"');
        $replace = '';
        $url = str_replace($search, $replace, $url);
        //var_dump($url);
        return $url[0];
    }
    /**
     * 去掉html标签
     * @param $arrayStr, 一维string数组或者string
     **/
    private function moveTags(&$arrayStr) {
        if (is_array($arrayStr)) {
            foreach ($arrayStr as &$value) {
                $value = strip_tags($value);
                $value = preg_replace('/\s*/', '', $value);
            }
        }else{
            $arrayStr = strip_tags($arrayStr);
            $arrayStr = preg_replace('/\s*/', '', $arrayStr);
        }
    }
    /**
     * curl去获取网页的数据
     * @param $url 获取的网址
     * @return $document
     **/
    private function getLib($url) {
        $args = array();
        $user_agent = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 设为TRUE让结果不要直接输出
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language:zh-CN,zh;q=0.8',
            'Connection: Keep-Alive',
            'Cache-Control:max-age=0',
            'Referer:http://202.116.41.246:8080/opac/search.php',
            'Expect:'
        ));
        curl_setopt($ch, CURLOPT_POST, true); //启用POST提交
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args); //设置POST提交的字符串
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent); //HTTP请求User-Agent:头
        $document = curl_exec($ch); //执行预定义的CURL
        curl_close($ch);
        return $document;
    }
}
