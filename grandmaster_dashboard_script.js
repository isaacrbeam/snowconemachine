$(function(){
	get_data_by_name('active_rev');//we want to load this data when first log in
	bind_buttons();
});

function bind_buttons(){
	get_data_by_name_by_btn('active_rev');
	get_data_by_name_by_btn('pending_rev');
	get_data_by_name_by_btn('admin_tools');
}

function get_data_by_name_by_btn(id_prefix){
	$("#"+id_prefix+"_btn").click(function(){
		get_data_by_name(id_prefix);
	});
}

function get_data_by_name(id_prefix){
	$.post("grandwizard_dashboard_ajax.php",{
			method:"get_"+id_prefix
		},function(formated_data_and_tools){
			change_active_tab_and_add_data(id_prefix,formated_data_and_tools);
		});
}

function change_active_tab_and_add_data(id_prefix,data_to_display){
	$(".dashboard_btn").removeClass('active');
	$(".dashboard").removeClass('active');	
	$("#"+id_prefix+"_btn").addClass('active');
	$("#"+id_prefix).addClass('active').html(data_to_display);
	enable_admin_js(id_prefix);
}

function enable_admin_js(id_prefix){
	if(id_prefix=="admin_tools"){
		$("#get_tool").on('change',function(){
			var selected=$(this).val();
			get_admin_tool(selected);
		});
	}
}

function get_admin_tool(tool_id){
	$.post("grandwizard_dashboard_ajax.php",{
		method:'get_tool_'+tool_id	
	},function(formated_tool_data){
		$("#admin_tool").html(formated_tool_data);
	});
}