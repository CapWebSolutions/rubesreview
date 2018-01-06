(function($){

	FLBuilder.registerModuleHelper('numbers', {
		
		init: function()
		{
			var form = $('.fl-builder-settings');
			
			this._toggleMaxNumber();
			
			form.find('select[name=layout]').on('change', this._toggleMaxNumber);
			form.find('select[name=number_type]').on('change', this._toggleMaxNumber);
			
			this._toggleShortcodeField();
			form.find('select[name=number_source]').on('change', this._toggleShortcodeField);

			this._validateNumber();
			form.find('input[name=number]').bind('keyup mouseup', this._validateNumber);
		},
		
		_toggleShortcodeField: function()
		{
			var form        	= $('.fl-builder-settings'),
				numberSource	= form.find('select[name=number_source]').val(),
				shortcodeField 	= form.find('#fl-field-inm_shortcode'); 
				numberField 	= form.find('#fl-field-number'); 
			
			if ( 'shortcode' == numberSource ) {
				shortcodeField.show();
				numberField.hide();
			}
			else {
				numberField.show();
				shortcodeField.hide();
			}
		},
		
		_toggleMaxNumber: function()
		{
			var form        = $('.fl-builder-settings'),
				layout  	= form.find('select[name=layout]').val(),
				numberType  = form.find('select[name=number_type]').val(),
				maxNumber   = form.find('#fl-field-max_number'); 
			
			if ( 'default' == layout ) {
				maxNumber.hide();
			}
			else if ( 'standard' == numberType ) {
				maxNumber.show();
			}
			else {
				maxNumber.hide();
			}
		},

		_validateNumber: function()
		{
			var form		= $('.fl-builder-settings'),
				numberInput = form.find('input[name=number]');

				numberInput.val( numberInput.val().replace(/[^0-9\.]/g,'') );
		}
	});

})(jQuery);