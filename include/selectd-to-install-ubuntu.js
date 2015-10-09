jQuery(document).ready(function() {

	// click select all chkbox.
	$("#chkClick_all").click(function() {
		if ($("#chkClick_all").attr("checked")) {
			$("input[name='chkbox[]']").each(function() {
				$(this).attr("checked", true);
			});
		} else {
			$("input[name='chkbox[]']").each(function() {
				$(this).attr("checked", false);
			});          
		}
	});

	// click install button.
	$("#btnInstall").click(function() {
		var varAptList = [];
		$("input[name='chkbox[]']:checked").each(function() {
			varAptList.push( $(this).val() );
		});

		//alert("apt://" + varAptList.join(','));		//對話視窗(apturl)。
		alert("sudo apt-get install " + varAptList.join(' '));	//對話視窗。
		location.href="apt://" + varAptList.join(',');	//導向至 URL。
	});
});
