<?php 

 // * 参数1：$fileObj   文件上传的数组  如：$fileObj = $_FILES['head_img'] 表单元素name = head_img
 // * 参数2：$dir   文件上传 目录,如：images/upload/  注意末尾的‘/’不能少
 // * 参数3：变量的地址  $filenameStr = "";   uploadSingle(,,$filenameStr,);     $filenameStr="img_23eherqwerhw23qe2.jpg";
 // * 参数4：允许上传的文件的后缀数组 有默认值是图片的后缀
	function uploadSingle($fileObj,$dir,&$fname,$exts=array("jpg","png","gif","jpeg","bmp")){
      //3）获取文件的扩展名 pathinfo()
      $ext = pathinfo($fileObj['name'],PATHINFO_EXTENSION);//4）判断文件扩展名是否合法 in_array()
           //   判断某个值是否是数组元素
           //   true  是
           //   false 否
      if(in_array($ext,$exts)){
       //5）重新定义文件名uuid--->uniqid();
        $filename = "img_".uniqid().".".$ext;
         //6） 移动上传的文件到到指定的目录（c:\wamp64\tmp）move_uploaded_file()
           //    move_uploaded_file(临时文件路径,上传的路径及文件名) true  上传成功
        if(move_uploaded_file($fileObj['tmp_name'],$dir.$filename)){
          $fname=$filename;
          return true;
        }else{
          return false;
        }
      }
    }

    
// 关于多张图片的显示问题
  // 如果 article_img 如果为空，需要去文章中取图片
  //                          content
  // 需要在content字段查找 <img src='xxx'>标签,需要用到正则表达式
  // 
  //参数1：content 在哪个字符串中查找图片
  function getImgs($content,$order='ALL'){  
        $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";  
        preg_match_all($pattern,$content,$match);  
        if(isset($match[1])&&!empty($match[1])){  
            if($order==='ALL'){  
                return $match[1];  
            }  
            if(is_numeric($order)&&isset($match[1][$order])){  
                return $match[1][$order];  
            }  
        }  
        return '';  
    }

    // $imgArrs = getImgs($articleArrs[1]['article_content']);
    // var_dump($imgArrs);
 ?>