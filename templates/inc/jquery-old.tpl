<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.ui.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script type="text/javascript" src="js/date.js"></script>
<script type="text/javascript" src="js/jquery.asmselect.js"></script>
<script type="text/javascript" src="js/autoresize.jquery.min.js"></script>
<link rel="stylesheet" href="css/datepickerFront.css" />
<link rel="stylesheet" type="text/css" href="js/jquery.asmselect.css">

<script type="text/javascript">
var pclose={if $working}true{else}false{/if};
{literal}


$(document).ready(function() {

$('#user_respons_sent').change(function(event){
    var x;
    if (confirm("You’re about to change the “Status” of this project to “Reviewed and sent to the client”. Are you sure you want to do it ?") == true) {
        x = "true";
    } else {
        x = "false";
    }

if(x=="true")
{

$.ajax({  type: "POST",
		   url: "?user_respons=1",
		   data:{ id_users:$(this).val(), id_project: $('#id_project').val() },
		   success: function(data) { console.log(data);}
		 });
}


});

$('table tr td:not(:last-child)').click(function(){
        if($(this).parent().attr('data-href'))
        {
        window.location =$(this).parent().attr('data-href');
        return false;
        }
    });

	$('textarea').autoResize();
	$('#message').focus(MsgFocus);
	var end = (new Date()).addDays(30).asString();
	var start = (new Date()).addDays(-356).asString();
	$('.date-pick').datePicker({dateFormat: 'dd-mm-yyyy',startDate:start,endDate:end});

	$(".sasmselect").asmSelect({
		sortable: true,
		animate: true,
		addItemTarget: 'top',
		index: 1
	});


	$("#frm").validate({
		  rules: {
			fpl: {
			  accept: "fpl"
			},
			ftr: {
			  required: true,
			  accept: "ftr"
			}
		  }
		});
	{/literal}
	{if !$stopinterval && $auth.user_id}
		var refreshId = setInterval(checkWorking, 10000);
	{/if}
	{literal}
	$("a").click(cancelPrevent);
	$("input").click(cancelPrevent);
	function cancelPrevent() {
		pclose=false;
	}
	$(".delete").click(
		function(){
			res=confirm('Are you sure?');
			return(res);
		}
	)
	$(".sterge").click(
		function(){
			res=confirm('Are you sure?');
			return(res);
		}
	)

});
function addFileField(name,separator) {
	hinput=separator+'<input type="file" id="'+name+'" class="texter" name="'+name+'[]" />';
	$('.inputfiles').append(hinput);
	return false;
}

function MsgFocus() {
	$("#btn_Send").show();
	$("#btn_Cancel").show();
}
function MsgSend() {
	$("#btn_Send").hide();
	$("#btn_Add").hide();
	$("#msgloader").show();
	$(".addmessage").fadeTo(10,0.5);
}
function checkWorking() {
		s_url="?working=1";
		$.ajax({
		   type: "POST",
		   url: s_url,
		   data: "",
		   success: workingResult
		 });
}

window.onbeforeunload = function(evt){
	if(pclose) return "You have open work";
};

function workingResult(data) {
	vdata=jQuery.parseJSON(data);
	$("#working").html(vdata.html);
	if(vdata.redirect) {
		window.location=vdata.redirect;
	}

	if(vdata.working==0) {
		pclose=false;
	} else {
		pclose=true;
	}
	if(vdata.hide) {
		$("#working").hide();
	} else {
		$("#working").show();
		$("input").click(cancelPrevent);
	}
}
</script>

{/literal}