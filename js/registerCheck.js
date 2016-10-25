function showDesc(obj)
{  
   var id= obj.name;
   document.getElementById(id).style.display="inline";
}

//输入框失去焦点时检验输入内容是否有效
function checkText(obj)
{
   //获取输入框的id值
   var id= obj.name;
   var text=document.getElementById(id.toString().toUpperCase()).value;

   //判断是否为空
   if(text.replace(/\s/g, "")=="")
   {
      document.getElementById(id).innerHTML="输入不能为空";
   }
   else
   {
     //组装方法
     //取首字母转换为大写,其余不变
     var firstChar=id.charAt(0).toString().toUpperCase();
     //
     var strsub=id.substring(1,id.length);
     var strMethod="check"+firstChar+strsub+"()";
     var isTrue = eval(strMethod);
     if(isTrue)
     {
         document.getElementById(id).innerHTML="输入有效";
     }
   }

   
} 

function checkUsername()
{
    //只简单的判断用户名的长度
    var id = document.getElementById("USERNAME");
    var username=id.value;    
    if(username.length > 10)
    {
      document.getElementById(id.name).innerHTML = "输入的用户名过长";
      return false;
    } 
    else
    return true;
}
function checkPassword()
{
    var password = document.getElementById("PASSWORD").value;    
    return true;
}
function checkPassword2()
{
     var id=document.getElementById("PASSWORD");
     var id2=document.getElementById("PASSWORD2");
     var password = id.value;    
     var password2 = id2.value;
     if(password!=password2)
     {
        document.getElementById(id.name).innerHTML="密码不一致";
        return false;
     }
     return true;    
}
function checkIDNumber()
{
  var id=document.getElementById("IDNUMBER"); 
  var IDNumber =id.value;
  if(IDNumber.length<18||IDNumber.length>19)
  {
    document.getElementById(id.name).innerHTML="身份证号长度有误";
    return false;
  }
  var expr=/([0]{18}[x|y]?)|([1]{18}[x|y]?)/i;
  if(expr.test(IDNumber))
  {
     document.getElementById(id.name).innerHTML="身份证号不可以全'0'或全'1'";
     return false;
  }
  return true;
}
function checkPhoneNumber()
{
// 利用正则表达式对输入数据匹配
   var id=document.getElementById("PHONENUMBER");
   var phone = id.value;     
//匹配到一个非数字字符，则返回false 
   var expr =  /\D/i;
   if(expr.test(phone))
   {
      document.getElementById(id.name).innerHTML="不能输入非数字字符";
      return false;
   }
   return true;

}
function checkEmail()
{
// 利用正则表达式对输入数据匹配
   var id =  document.getElementById("EMAIL")
   var email = id.value;    
//以字母或数字开头，跟上@,字母数字以.com结尾
   var expr =  /^([0-9]|[a-z])+@([0-9]|[a-z])+(\.[c][o][m])$/i;
   if(!expr.test(email))
   {
      document.getElementById(id.name).innerHTML="输入的邮箱格式有误";
      return false;
   }
   return true;
}
