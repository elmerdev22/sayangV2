var select2_child_input = function select2_child_input(data, label=true, place_holder = null, set_action = true){

	var select2_data = [];

	if(label){
        select2_data.push({
            id  : "",
            text: "Select",
            html: `<div>Select</div>`
        });
    }

	for(var key in data){
        var name = data[key]['name'];
        var id   = data[key]['id'];

        select2_data.push({
            id  : id,
            text: name,
            html: name
        });
    }

    function select2_custom_template(data_template) {
        return data_template.html;
    }
	
	return {
        placeholder   : place_holder,
        closeOnSelect : set_action,
        data          : select2_data,
        theme         : 'bootstrap4',
        templateResult: select2_custom_template,
        height        : 'resolve',                 //override the height
        width         : '100%',                    //override the width
        escapeMarkup  : function (markup) {
           return markup;
        }
     };	    
}