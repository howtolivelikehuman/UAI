function password_check(){
	var pw = document.getElementById('pw');
	var cpw = document.getElementById('cpw');
	if(pw.value != cpw.value){
		cpw.setCustomValidity('비밀번호가 일치하지 않습니다.');
	}
	else{
		cpw.setCustomValidity('');
	}
}
function bday_check(){
	var year = document.getElementById('byear');
	var month = document.getElementById('bmonth');
	var date = document.getElementById('bdate');
	var is_leapyear;
	if(((year.value % 4 == 0) && (year.value % 100 != 0)) || (year.value % 400 == 0)){
		is_leapyear = true;
	}
	else{
		is_leapyear= false;
	}
	switch(month.value){
		case "04":case "06": case "09": case "11":{
			if(date.value>30){
				date.setCustomValidity('날짜가 올바르지 않습니다.');
			}
			else{
				date.setCustomValidity('');
			}
			break;
		}
		case "02":{
			if(is_leapyear){
				if(date.value>29){
					date.setCustomValidity('날짜가 올바르지 않습니다.');
				}
				else{
					date.setCustomValidity('');
				}
				break;
			}
			else{
				if(date.value>28){
					date.setCustomValidity('날짜가 올바르지 않습니다.');
				}
				else{
					date.setCustomValidity('');
				}
				break;
			}
		}
		default:{
			date.setCustomValidity('');
		}
		break;
	}
}