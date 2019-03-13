function doSelect(){//确认键 
//	setCookie("pagePos", pagePos, '1d');
//	setCookie("listPos", listPos, '1d');
	if(detailArea=='home'){
		location.href = 'index.htm';
	}else if(detailArea=='main'){
		location.href = 'index.htm';
	}else if(detailArea=='back'){
		location.href = 'index.htm';
	}else if(detailArea=='chapterNum'){
		alert( chapterNums[(chapterPagePos+chapterPageHidden)*10+chapterPos] );
	}else if(detailArea=='list'){
		from = 'detailRecommend';
		fromPos = detailListPos;
		setCookie("from", from, '1d');
		setCookie("fromPos", fromPos, '1d');
		location.href = 'detail.htm';//+Math.random();
	}else if(detailArea=='exitList'){
		from = 'exitRecommend';
		fromPos = exitPos+exitHidden;
		setCookie("from", from, '1d');
		setCookie("fromPos", fromPos, '1d');
		location.href = 'detail.htm';//+Math.random();		
	}else if(detailArea=='play'){
		if(buy==0){
			alert('先试看10分钟，再运行下面的代码');
			detailArea = 'price';
			changePrice(0);
			$('buyPrompt').style.display = 'block';
		//	$('promptTitle').innerHTML = '温馨提示';
		//	$('promptText').innerHTML = '&emsp;&emsp;您末购买此片，若继续观看，请选择购买此套餐。《天华专区》套餐 30元/月 ，购买后该套餐内所有节目均可观看！';
		}else{
			alert('这里需加入播放代码');
		}
	}else if(detailArea=='buy'){
		detailArea = 'price';
		$('buyPrompt').style.display = 'block';
	//	$('promptTitle').innerHTML = '优惠套餐';
	//	$('promptText').innerHTML = '尊敬的用户：<br>&emsp;&emsp;您好！您选择开通《天华专区》套餐，价格为25元，开通后套餐内所有节目均可观看。<br>是否开通？';
		showBtn();
		changePrice(0);
	//	showBuyBtn();
	}else if(detailArea=='collect'){
		collect = (collect==0)?1:0;
		showBtn();
	}else if(detailArea=='price'){
		detailArea ='ok';
		//这里要加订购的东东，根据pricePos确定买什么套餐 
		buy = 1;//这里的值要根据订购成功与否，成功为1，否为0 
		$('promptTitle').innerHTML = '温馨提示';
		$('buyPromptOk').style.display = 'inline-block';
		for(i=0;i<4;i++){
			$('price'+i).style.display = 'none';
		}
		$('promptText').style.color = 'white';
		if( buy==1){
			$('promptText').innerHTML = '<br>&emsp;&emsp;您已开通《天华专区》'+priceArr[pricePos]+'套餐，该套餐内所有节目均可观看，欢迎使用！';
		}else{
			$('promptText').innerHTML = '<br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;订购失败，详情咨询：96335';
		}
	}else if(detailArea=='ok'){
		$('buyPrompt').style.display = 'none';
		detailArea = (buy==1)?'play':'buy';
		showBtn();
	}else if(detailArea=='exitBtn'){
		if(exitBtnPos==0){
			alert('下一集');//下一集
		}else if(exitBtnPos==1){
			alert('退出');
		}else if(exitBtnPos==2){
			alert('继续');
		}
	}else if( detailArea=="versionPrompt" ){
		detailArea ="play";
		$("versionPrompt").style.display = "none";
		showBtn();
	}/*else if(detailArea=='cancel' && buy==0){
		detailArea = 'buy';
		$('buyPrompt').style.display = 'none';
		showBtn();
	}else if(detailArea=='continue'){//这里要改成继续播放的代码
		detailArea = 'buy';
		$('buyPrompt').style.display = 'none';
		$('exitList').style.display = 'none';
		showBtn();
	}else if(detailArea=='exit'){//这里要改成退出播放的代码
		detailArea = 'buy';
		$('buyPrompt').style.display = 'none';
		$('exitList').style.display = 'none';
		showBtn();
	}*/
} 

//按键
document.onsystemevent = eventHandler;
//document.onkeypress    = eventHandler;
document.onirkeypress  = eventHandler; 
function eventHandler(e,type){
	var key_code = "";
	if(navigator.userAgent.indexOf('iPanel')!=-1){
		key_code=iPanelKey();
	}else key_code = e.code ;
	switch(key_code){		
		case "KEY_UP": 
			if( detailArea=='list'){
				detailArea ='play';
				changeList(0);
				showBtn();
				$('focusDiv').style.display = 'none';
			}else if( detailArea=='chapterPage'){
				detailArea ='chapterNum';
				changeChapterPage(0);
			}else if( detailArea=='chapterNum'){
				detailArea ='choose';
				changeChapterPage(0);
			//	changeChapter(0);
				showBtn();
			}else if( detailArea=='play' ||detailArea=='buy' ||detailArea=='choose' ||detailArea=='collect' ){
				detailArea ='home';	
				changeRightCornerBg();
				showBtn();
				$('chooseChapter').style.display = (detailArea=='choose')?'block':'none';
				$('recommend').style.display = (detailArea=='choose')?'none':'block';
			}else if( detailArea=='exitBtn'){
				detailArea = 'exitList';
			//	$('focusDiv').style.display = 'block';
				changeExitBtn(0);
				changeExitList(0);
			}else if( detailArea=='price' ){
				changePrice(-1);
			}
			return 0;
			break;
			
		case "KEY_DOWN":
			if( detailArea=='home' || detailArea=='main' || detailArea=='back'){
				detailArea = 'play';
				showBtn();
				changeRightCornerBg();
			}else if( detailArea=='play' ||detailArea=='buy' ||detailArea=='collect' ){
				detailArea = 'list';
				$('focusDiv').style.display = 'block';
				changeList(0);
				showBtn();
			}else if( detailArea=='choose'){
				detailArea = 'chapterNum';
				showBtn();
				changeChapter(0);
			}else if( detailArea=='chapterNum'){
				detailArea = 'chapterPage';
				changeChapter(0);
				changeChapterPage(0);
			}else if( detailArea=='exitList' ){
				detailArea = 'exitBtn';
				$('focusDiv').style.display = 'none';
				changeExitBtn(0);
				changeExitList(0);
			}else if( detailArea=='price' ){
				changePrice(1);
			}
			return 0;
			break;
			
		case "KEY_LEFT": 
			if( detailArea=='back'){
				detailArea = 'main';
				changeRightCornerBg();
			}else if( detailArea=='main'){
				detailArea = 'home';
				changeRightCornerBg();
			}else if( detailArea=='collect'){
				if( chapters>1){
					detailArea = 'choose';
					$('chooseChapter').style.display = (detailArea=='choose')?'block':'none';		
					$('focusDiv').style.display = (detailArea=='list')?'block':'none';
					$('recommend').style.display = (detailArea=='choose')?'none':'block';
				}else if( buy==0){
					detailArea = 'buy';	
				}else if( buy>0){
					detailArea = 'play';	
				}
				showBtn();
			}/*else if( detailArea=='follow'){
				detailArea = 'choose';
				$('chooseChapter').style.display = (detailArea=='choose')?'block':'none';		
				$('focusDiv').style.display = (detailArea=='list')?'block':'none';
				$('recommend').style.display = (detailArea=='choose')?'none':'block';
				showBtn();
			}*/else if( detailArea=='choose'){
				if( buy>0){
					detailArea = 'play';
				}else{
					detailArea = 'buy';	
				}
				showBtn();
				$('chooseChapter').style.display = (detailArea=='choose')?'block':'none';		
				$('focusDiv').style.display = (detailArea=='list')?'block':'none';
				$('recommend').style.display = (detailArea=='choose')?'none':'block';
			}else if( detailArea=='buy'){
				detailArea = 'play';
				showBtn();
			}else if( detailArea=='chapterNum'){
				changeChapter(-1);
			}else if( detailArea=='chapterPage'){
				changeChapterPage(-1);
			}else if(detailArea=='list'){
				changeList(-1);
			}/*else if(detailArea=='cancel'){
				detailArea = 'ok';
				showBuyBtn();
			}*/else if(detailArea=='exitBtn'){
				changeExitBtn(-1);
			}else if(detailArea=='exitList'){
				changeExitList(-1);
			}else if( detailArea=='price'){
				detailArea = 'buy';
				$('buyPrompt').style.display = 'none';
				showBtn();
			}
			return 0;
			break;
			
		case "KEY_RIGHT": 
			if( detailArea=='home'){
				detailArea ='main';
				changeRightCornerBg();
			}else if( detailArea=='main'){
				detailArea = 'back';
				changeRightCornerBg();
			}else if( detailArea=='play'){
				if( buy==0){
					detailArea = 'buy';
				}else if( chapters>1){
					detailArea = 'choose';
					$('chooseChapter').style.display = (detailArea=='choose')?'block':'none';		
					$('focusDiv').style.display = (detailArea=='list')?'block':'none';
					$('recommend').style.display = (detailArea=='choose')?'none':'block';
					showChapter();
					showChapterPage();
				}else{
					detailArea = 'collect';
				}
				showBtn();
			}else if( detailArea=='buy'){
				if( chapters>1){
					detailArea = 'choose';
					$('chooseChapter').style.display = (detailArea=='choose')?'block':'none';	
					$('focusDiv').style.display = (detailArea=='list')?'block':'none';
					$('recommend').style.display = (detailArea=='choose')?'none':'block';
					showChapter();
					showChapterPage();
				}else{
					detailArea = 'collect';
				}
				showBtn();
			}else if( detailArea=='choose'){
				detailArea = 'collect';
				$('chooseChapter').style.display = (detailArea=='choose')?'block':'none';	
				$('focusDiv').style.display = (detailArea=='list')?'block':'none';
				$('recommend').style.display = (detailArea=='choose')?'none':'block';
				showBtn();
			}/*else if( detailArea=='follow'){
				detailArea = 'collect';
				$('chooseChapter').style.display = (detailArea=='choose')?'block':'none';	
				$('focusDiv').style.display = (detailArea=='list')?'block':'none';
				$('recommend').style.display = (detailArea=='choose')?'none':'block';
				showBtn();
			}*/else if(detailArea=='list'){
				changeList(1);
			}else if(detailArea=='chapterNum'){
				changeChapter(1);
			}else if(detailArea=='chapterPage'){
				changeChapterPage(1);
			}/*else if(detailArea=='ok' && $('buyPromptCancel').style.display != 'none'){
				detailArea = 'cancel';
				showBuyBtn();
			}*/else if(detailArea=='exitBtn'){
				changeExitBtn(1);
			}else if(detailArea=='exitList'){
				changeExitList(1);
			}else if( detailArea=='price'){
				detailArea = 'buy';
				$('buyPrompt').style.display = 'none';
				showBtn();
			}
			return 0;
			break;	
			
		case "PAGE_DOWN":
		    return 0;
			break;	
			
		case "PAGE_UP":
		case 25:
		    return 0;
			break;		
				
		case "KEY_SELECT":
			doSelect();
			return 0;
			break;
			
		case "KEY_BACK":
		    document.onkeypress    = eventHandler;
		//	e.preventDefault();
			if( detailArea=='price'){
				detailArea = 'buy';
				$('buyPrompt').style.display = 'none';
				showBtn();
			}
			return false;
			break;	
			
		case "KEY_EXIT":
			detailArea = 'exitBtn';
			showExit();
			changeExitBtn(0);
			return false;
			break;
			
		case "KEY_NUMERIC49":
			return 0;
			break;
			
		case "KEY_NUMERIC50":
			return 0;
			break;
			
		case "KEY_NUMERIC51":
			return 0;
			break;
	}
}