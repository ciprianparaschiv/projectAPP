/*
 * jQuery validation plug-in v1.2.1
 *
 * http://bassistance.de/jquery-plugins/jquery-plugin-validation/
 * http://docs.jquery.com/Plugins/Validation
 *
 * Copyright (c) 2006 - 2008 Jörn Zaefferer
 *
 * $Id: jquery.validate.js 4708 2008-02-10 16:04:08Z joern.zaefferer $
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
 
 	errRequired='<br/>Acest camp este obligatoriu';
	errRemote='Reparati aces camp';
	errEmail='Introduceti o adresa de e-mail valida';
	errUrl='Introduceti un URL valid';
	errDate='Introduceti o data valida';
	errDateISO='Introduceti o data valida (ISO)';
	errNumber='Introduceti un numar';
	errDigits='Introduceti doar cifre';
	errCreditCard='Introduceti un numar de card valid';
	errEqualTo='Introduceti acceasi valoare din nou';
	errAccept='Introduceti o valoare cu extensie valida';
	errMaxLength='Nu introduceti mai mult de {0} caractere';
	errMinLength='Introduceti cel putin {0} caractere';
	errRangeLength='Introduceti intre {0} si {1} caractere';
	errRangeValue='Introduceti o valoare intre {0} si {1}';
	errMaxValue='Introduceti o valoare mai mica sau egala cu {0}';
	errMinValue='Introduceti o valoare mai mare sau egala cu {0}';
 

jQuery.extend(jQuery.fn, {
	// http://docs.jquery.com/Plugins/Validation/validate
	validate: function( options ) {
		
		// if nothing is selected, return nothing; can't chain anyway
		if (!this.length) {
			options && options.debug && window.console && console.warn( "nothing selected, can't validate, returning nothing" );
			return;
		}
		
		// check if a validator for this form was already created
		var validator = jQuery.data(this[0], 'validator');
		if ( validator ) {
			return validator;
		}
		
		validator = new jQuery.validator( options, this[0] );
		jQuery.data(this[0], 'validator', validator); 
		
		if ( validator.settings.onsubmit ) {
		
			// allow suppresing validation by adding a cancel class to the submit button
			this.find("input.cancel:submit").click(function() {
				validator.cancelSubmit = true;
			});
		
			// validate the form on submit
			this.submit( function( event ) {
				if ( validator.settings.debug )
					// prevent form submit to be able to see console output
					event.preventDefault();
					
				function handle() {
					if ( validator.settings.submitHandler ) {
						validator.settings.submitHandler.call( validator, validator.currentForm );
						return false;
					}
					return true;
				}
					
				// prevent submit for invalid forms or custom submit handlers
				if ( validator.cancelSubmit ) {
					validator.cancelSubmit = false;
					return handle();
				}
				if ( validator.form() ) {
					if ( validator.pendingRequest ) {
						validator.formSubmitted = true;
						return false;
					}
					return handle();
				} else {
					validator.focusInvalid();
					return false;
				}
			});
		}
		
		return validator;
	},
	// http://docs.jquery.com/Plugins/Validation/valid
	valid: function() {
        if ( jQuery(this[0]).is('form')) {
            return this.validate().form();
        } else {
            var valid = true;
            var validator = jQuery(this[0].form).validate();
            this.each(function() {
                valid = validator.element(this) && valid;
            });
            return valid;
        }
    },
	// http://docs.jquery.com/Plugins/Validation/rules
	rules: function() {
		var element = this[0];
		var data = jQuery.validator.normalizeRules(
		jQuery.extend(
			{},
			jQuery.validator.metadataRules(element),
			jQuery.validator.classRules(element),
			jQuery.validator.attributeRules(element),
			jQuery.validator.staticRules(element)
		), element);
	
		// convert from object to array
		var rules = [];
		// make sure required is at front
		if (data.required) {
			rules.push({method:'required', parameters: data.required});
			delete data.required;
		}
		jQuery.each(data, function(method, value) {
			rules.push({
				method: method,
				parameters: value
			});
		});
		return rules;
	},
	// destructive add
	push: function( t ) {
		return this.setArray( this.add(t).get() );
	}
});

// Custom selectors
jQuery.extend(jQuery.expr[":"], {
	// http://docs.jquery.com/Plugins/Validation/blank
	blank: "!jQuery.trim(a.value)",
	// http://docs.jquery.com/Plugins/Validation/filled
	filled: "!!jQuery.trim(a.value)",
	// http://docs.jquery.com/Plugins/Validation/unchecked
	unchecked: "!a.checked"
});

jQuery.format = function(source, params) {
	if ( arguments.length == 1 ) 
		return function() {
			var args = jQuery.makeArray(arguments);
			args.unshift(source);
			return jQuery.format.apply( this, args );
		};
	if ( arguments.length > 2 && params.constructor != Array  ) {
		params = jQuery.makeArray(arguments).slice(1);
	}
	if ( params.constructor != Array ) {
		params = [ params ];
	}
	jQuery.each(params, function(i, n) {
		source = source.replace(new RegExp("\\{" + i + "\\}", "g"), n);
	});
	return source;
};

// constructor for validator
jQuery.validator = function( options, form ) {
	this.settings = jQuery.extend( {}, jQuery.validator.defaults, options );
	this.currentForm = form;
	this.init();
};

jQuery.extend(jQuery.validator, {

	defaults: {
		messages: {},
		errorClass: "error",
		errorElement: "label",
		focusInvalid: true,
		errorContainer: jQuery( [] ),
		errorLabelContainer: jQuery( [] ),
		onsubmit: true,
		ignore: [],
		onfocusin: function(element) {
			this.lastActive = element;
				
			// hide error label and remove error class on focus if enabled
			if ( this.settings.focusCleanup && !this.blockFocusCleanup ) {
				this.settings.unhighlight && this.settings.unhighlight.call( this, element, this.settings.errorClass );
				this.errorsFor(element).hide();
			}
		},
		onfocusout: function(element) {
			if ( !this.checkable(element) && (element.name in this.submitted || !this.optional(element)) ) {
				this.element(element);
			}
		},
		onkeyup: function(element) {
			if ( element.name in this.submitted || element == this.lastElement ) {
				this.element(element);
			}
		},
		onclick: function(element) {
			if ( element.name in this.submitted )
				this.element(element);
		},
		highlight: function( element, errorClass ) {
			jQuery( element ).addClass( errorClass );
		},
		unhighlight: function( element, errorClass ) {
			jQuery( element ).removeClass( errorClass );
		}
	},

	// http://docs.jquery.com/Plugins/Validation/Validator/setDefaults
	setDefaults: function(settings) {
		jQuery.extend( jQuery.validator.defaults, settings );
	},

	messages: {
		required: errRequired,
		remote: errRemote,
		email: errEmail,
		url: errUrl,
		date: errDate,
		dateISO: errDateISO,
		dateDE: errDateISO,
		number: errNumber,
		numberDE: errNumber,
		digits: errDigits,
		creditcard: errCreditCard,
		equalTo: errEqualTo,
		accept: errAccept,
		maxlength: jQuery.format(errMaxLength),
		maxLength: jQuery.format(errMaxLength),
		minlength: jQuery.format(errMinLength),
		minLength: jQuery.format(errMinLength),
		rangelength: jQuery.format(errRangeLength),
		rangeLength: jQuery.format(errRangeLength),
		rangeValue: jQuery.format(errRangeValue),
		range: jQuery.format(errRangeValue),
		maxValue: jQuery.format(errMaxValue),
		max: jQuery.format(errMaxValue),
		minValue: jQuery.format(errMinValue),
		min: jQuery.format(errMinValue)
	},
	autoCreateRanges: false,
	
	prototype: {
		
		init: function() {
			this.labelContainer = jQuery(this.settings.errorLabelContainer);
			this.errorContext = this.labelContainer.length && this.labelContainer || jQuery(this.currentForm);
			this.containers = jQuery(this.settings.errorContainer).add( this.settings.errorLabelContainer );
			this.submitted = {};
			this.valueCache = {};
			this.pendingRequest = 0;
			this.pending = {};
			this.invalid = {};
			this.reset();
			
			function delegate(event) {
				var validator = jQuery.data(this[0].form, "validator");
				validator.settings["on" + event.type] && validator.settings["on" + event.type].call(validator, this[0] );
			}
			jQuery(this.currentForm)
				.delegate("focusin focusout keyup", ":text, :password, :file, select, textarea", delegate)
				.delegate("click", ":radio, :checkbox", delegate);
		},

		// http://docs.jquery.com/Plugins/Validation/Validator/form
		form: function() {
			this.prepareForm();
			var elements = this.elements();
			for ( var i = 0; elements[i]; i++ ) {
				this.check( elements[i] );
			}
			jQuery.extend(this.submitted, this.errorMap);
			this.invalid = jQuery.extend({}, this.errorMap);
			jQuery(this.currentForm).triggerHandler("invalid-form.validate", [this]);
			this.showErrors();
			return this.valid();
		},
		
		// http://docs.jquery.com/Plugins/Validation/Validator/element
		element: function( element ) {
			element = this.clean( element );
			this.lastElement = element;
			this.prepareElement( element );
			var result = this.check( element );
			if ( result ) {
				delete this.invalid[element.name];
			} else {
				this.invalid[element.name] = true;
			}
			if ( !this.numberOfInvalids() ) {
				// Hide error containers on last error
				this.toHide.push( this.containers );
			}
			this.showErrors();
			return result;
		},

		// http://docs.jquery.com/Plugins/Validation/Validator/showErrors
		showErrors: function(errors) {
			if(errors) {
				// add items to error list and map
				jQuery.extend( this.errorMap, errors );
				this.errorList = [];
				for ( var name in errors ) {
					this.errorList.push({
						message: errors[name],
						element: this.findByName(name)[0]
					});
				}
				// remove items from success list
				this.successList = jQuery.grep( this.successList, function(element) {
					return !(element.name in errors);
				});
			}
			this.settings.showErrors
				? this.settings.showErrors.call( this, this.errorMap, this.errorList )
				: this.defaultShowErrors();
		},
		
		// http://docs.jquery.com/Plugins/Validation/Validator/resetForm
		resetForm: function() {
			if ( jQuery.fn.resetForm )
				jQuery( this.currentForm ).resetForm();
			this.prepareForm();
			this.hideErrors();
			this.elements().removeClass( this.settings.errorClass );
		},
		
		numberOfInvalids: function() {
			var count = 0;
			for ( var i in this.invalid )
				count++;
			return count;
		},
		
		hideErrors: function() {
			this.addWrapper( this.toHide ).hide();
		},
		
		valid: function() {
			return this.size() == 0;
		},
		
		size: function() {
			return this.errorList.length;
		},
		
		focusInvalid: function() {
			if( this.settings.focusInvalid ) {
				try {
					jQuery(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus();
				} catch(e) { /* ignore IE throwing errors when focusing hidden elements */ }
			}
		},
		
		findLastActive: function() {
			var lastActive = this.lastActive;
			return lastActive && jQuery.grep(this.errorList, function(n) {
				return n.element.name == lastActive.name;
			}).length == 1 && lastActive;
		},
		
		elements: function() {
			var validator = this;
			
			
			var rulesCache = {};
			
			// select all valid inputs inside the form (no submit or reset buttons)
			// workaround with jQuery([]).add until http://dev.jquery.com/ticket/2114 is solved
			return jQuery([]).add(this.currentForm.elements)
			.filter("input, select, textarea")
			.not(":submit, :reset, [disabled]")
			.not( this.settings.ignore )
			.filter(function() {
				!this.name && validator.settings.debug && window.console && console.error( "%o has no name assigned", this);
			
				// select only the first element for each name, and only those with rules specified
				if ( this.name in rulesCache || !jQuery(this).rules().length )
					return false;
				
				rulesCache[this.name] = true;
				return true;
			});
		},
		
		clean: function( selector ) {
			return jQuery( selector )[0];
		},
		
		errors: function() {
			return jQuery( this.settings.errorElement + "." + this.settings.errorClass, this.errorContext );
		},
		
		reset: function() {
			this.successList = [];
			this.errorList = [];
			this.errorMap = {};
			this.toShow = jQuery( [] );
			this.toHide = jQuery( [] );
			this.formSubmitted = false;
		},
		
		prepareForm: function() {
			this.reset();
			this.toHide = this.errors().push( this.containers );
		},
		
		prepareElement: function( element ) {
			this.reset();
			this.toHide = this.errorsFor( this.clean(element) );
		},
	
		check: function( element ) {
			element = this.clean( element );
			this.settings.unhighlight && this.settings.unhighlight.call( this, element, this.settings.errorClass );
			var rules = jQuery(element).rules();
			for( var i = 0; rules[i]; i++) {
				var rule = rules[i];
				try {
					var result = jQuery.validator.methods[rule.method].call( this, jQuery.trim(element.value), element, rule.parameters );
					if ( result == "dependency-mismatch" )
						return;
					if ( result == "pending" ) {
						this.toHide = this.toHide.not( this.errorsFor(element) );
						return;
					}
					if( !result ) {
						this.formatAndAdd( element, rule );
						return false;
					}
				} catch(e) {
					this.settings.debug && window.console && console.warn("exception occured when checking element " + element.id
						 + ", check the '" + rule.method + "' method");
					throw e;
				}
			}
			if ( rules.length )
				this.successList.push(element);
			return true;
		},
		
		// return the custom message for the given element name and validation method
		customMessage: function( name, method ) {
			var m = this.settings.messages[name];
			return m && (m.constructor == String
				? m
				: m[method]);
		},
		
		// return the first defined argument, allowing empty strings
		findDefined: function() {
			for(var i = 0; i < arguments.length; i++) {
				if (arguments[i] !== undefined)
					return arguments[i];
			}
			return undefined;
		},
		
		defaultMessage: function( element, method) {
			return this.findDefined(
				this.customMessage( element.name, method ),
				// title is never undefined, so handle empty string as undefined
				element.title || undefined,
				jQuery.validator.messages[method],
				"<strong>Warning: No message defined for " + element.name + "</strong>"
			);
		},
		
		formatAndAdd: function( element, rule ) {
			var message = this.defaultMessage( element, rule.method );
			if ( typeof message == "function" ) 
				message = message.call(this, rule.parameters, element);
			this.errorList.push({
				message: message,
				element: element
			});
			this.errorMap[element.name] = message;
			this.submitted[element.name] = message;
		},
		
		addWrapper: function(toToggle) {
			if ( this.settings.wrapper )
				toToggle.push( toToggle.parents( this.settings.wrapper ) );
			return toToggle;
		},
		
		defaultShowErrors: function() {
			for ( var i = 0; this.errorList[i]; i++ ) {
				var error = this.errorList[i];
				this.settings.highlight && this.settings.highlight.call( this, error.element, this.settings.errorClass );
				this.showLabel( error.element, error.message );
			}
			if( this.errorList.length ) {
				this.toShow.push( this.containers );
			}
			if (this.settings.success) {
				for ( var i = 0; this.successList[i]; i++ ) {
					this.showLabel( this.successList[i] );
				}
			}
			this.toHide = this.toHide.not( this.toShow );
			this.hideErrors();
			this.addWrapper( this.toShow ).show();
		},
		
		showLabel: function(element, message) {
			var label = this.errorsFor( element );
			if ( label.length ) {
				// refresh error/success class
				label.removeClass().addClass( this.settings.errorClass );
			
				// check if we have a generated label, replace the message then
				label.attr("generated") && label.html(message);
			} else {
				// create label
				label = jQuery("<" + this.settings.errorElement + "/>")
					.attr({"for":  this.idOrName(element), generated: true})
					.addClass(this.settings.errorClass)
					.html(message || "");
				if ( this.settings.wrapper ) {
					// make sure the element is visible, even in IE
					// actually showing the wrapped element is handled elsewhere
					label = label.hide().show().wrap("<" + this.settings.wrapper + ">").parent();
				}
				if ( !this.labelContainer.append(label).length )
					this.settings.errorPlacement
						? this.settings.errorPlacement(label, jQuery(element) )
						: label.insertAfter(element);
			}
			if ( !message && this.settings.success ) {
				label.text("");
				typeof this.settings.success == "string"
					? label.addClass( this.settings.success )
					: this.settings.success( label );
			}
			this.toShow.push(label);
		},
		
		errorsFor: function(element) {
			return this.errors().filter("[@for='" + this.idOrName(element) + "']");
		},
		
		idOrName: function(element) {
			return this.checkable(element) ? element.name : element.id || element.name;
		},

		rules: function( element ) {
			return jQuery(element).rules();
		},

		checkable: function( element ) {
			return /radio|checkbox/i.test(element.type);
		},
		
		findByName: function( name ) {
			// select by name and filter by form for performance over form.find("[name=...]")
			var form = this.currentForm;
			return jQuery(document.getElementsByName(name)).map(function(index, element) {
				return element.form == form && element || null;
				//  && element.name == name
			});
		},
		
		getLength: function(value, element) {
			switch( element.nodeName.toLowerCase() ) {
			case 'select':
				return jQuery("option:selected", element).length;
			case 'input':
				if( this.checkable( element) )
					return this.findByName(element.name).filter(':checked').length;
			}
			return value.length;
		},
	
		depend: function(param, element) {
			return this.dependTypes[typeof param]
				? this.dependTypes[typeof param](param, element)
				: true;
		},
	
		dependTypes: {
			"boolean": function(param, element) {
				return param;
			},
			"string": function(param, element) {
				return !!jQuery(param, element.form).length;
			},
			"function": function(param, element) {
				return param(element);
			}
		},
		
		optional: function(element) {
			return !jQuery.validator.methods.required.call(this, jQuery.trim(element.value), element) && "dependency-mismatch";
		},
		
		startRequest: function(element) {
			if (!this.pending[element.name]) {
				this.pendingRequest++;
				this.pending[element.name] = true;
			}
		},
		
		stopRequest: function(element, valid) {
			this.pendingRequest--;
			// sometimes synchronization fails, make pendingRequest is never < 0
			if (this.pendingRequest < 0)
				this.pendingRequest = 0;
			delete this.pending[element.name];
			if ( valid && this.pendingRequest == 0 && this.formSubmitted && this.form() ) {
				jQuery(this.currentForm).submit();
			}
		},
		
		previousValue: function(element) {
			return jQuery.data(element, "previousValue") || jQuery.data(element, "previousValue", previous = {
				old: null,
				valid: true,
				message: this.defaultMessage( element, "remote" )
			});
		}
		
	},
	
	classRuleSettings: {
		required: {required: true},
		email: {email: true},
		url: {url: true},
		date: {date: true},
		dateISO: {dateISO: true},
		dateDE: {dateDE: true},
		number: {number: true},
		numberDE: {numberDE: true},
		digits: {digits: true},
		creditcard: {creditcard: true}
	},
	
	addClassRules: function(className, rules) {
		className.constructor == String ?
			this.classRuleSettings[className] = rules :
			jQuery.extend(this.classRuleSettings, className);
	},
	
	classRules: function(element) {
		var rules = {};
		var classes = jQuery(element).attr('class');
		classes && jQuery.each(classes.split(' '), function() {
			if (this in jQuery.validator.classRuleSettings) {
				jQuery.extend(rules, jQuery.validator.classRuleSettings[this]);
			}
		});
		return rules;
	},
	
	attributeRules: function(element) {
		var rules = {};
		var $element = jQuery(element);
		
		for (method in jQuery.validator.methods) {
			var value = $element.attr(method);
			// allow 0 but neither undefined nor empty string
			if (value !== undefined && value !== '') {
				rules[method] = value;
			}
		}
		
		// maxlength may be returned as -1, 2147483647 (IE) and 524288 (safari) for text inputs
		if (rules.maxlength && /-1|2147483647|524288/.test(rules.maxlength)) {
			delete rules.maxlength;
			// deprecated
			delete rules.maxLength;
		}
		
		return rules;
	},
	
	metadataRules: function(element) {
		if (!jQuery.metadata) return {};
		
		var meta = jQuery.data(element.form, 'validator').settings.meta;
		return meta ?
			jQuery(element).metadata()[meta] :
			jQuery(element).metadata();
	},
	
	staticRules: function(element) {
		var rules = {};
		var validator = jQuery.data(element.form, 'validator');
		if (validator.settings.rules) {
			rules = jQuery.validator.normalizeRule(validator.settings.rules[element.name]) || {};
		}
		return rules;
	},
	
	normalizeRules: function(rules, element) {
		// convert deprecated rules
		jQuery.each({
			minLength: 'minlength',
			maxLength: 'maxlength',
			rangeLength: 'rangelength',
			minValue: 'min',
			maxValue: 'max',
			rangeValue: 'range'
		}, function(dep, curr) {
			if (rules[dep]) {
				rules[curr] = rules[dep];
				delete rules[dep];
			}
		});
		
		// evaluate parameters
		jQuery.each(rules, function(rule, parameter) {
			rules[rule] = jQuery.isFunction(parameter) ? parameter(element) : parameter;
		});
		
		// clean number parameters
		jQuery.each(['minlength', 'maxlength', 'min', 'max'], function() {
			if (rules[this]) {
				rules[this] = Number(rules[this]);
			}
		});
		jQuery.each(['rangelength', 'range'], function() {
			if (rules[this]) {
				rules[this] = [Number(rules[this][0]), Number(rules[this][1])];
			}
		});
		
		if (jQuery.validator.autoCreateRanges) {
			// auto-create ranges
			if (rules.min && rules.max) {
				rules.range = [rules.min, rules.max];
				delete rules.min;
				delete rules.max;
			}
			if (rules.minlength && rules.maxlength) {
				rules.rangelength = [rules.minlength, rules.maxlength];
				delete rules.minlength;
				delete rules.maxlength;
			}
		}
		
		return rules;
	},
	
	// Converts a simple string to a {string: true} rule, e.g., "required" to {required:true}
	normalizeRule: function(data) {
		if( typeof data == "string" ) {
			var transformed = {};
			transformed[data] = true;
			data = transformed;
		}
		return data;
	},
	
	// http://docs.jquery.com/Plugins/Validation/Validator/addMethod
	addMethod: function(name, method, message) {
		jQuery.validator.methods[name] = method;
		jQuery.validator.messages[name] = message;
		if (method.length < 3) {
			jQuery.validator.addClassRules(name, jQuery.validator.normalizeRule(name));
		}
	},

	methods: {

		// http://docs.jquery.com/Plugins/Validation/Methods/required
		required: function(value, element, param) {
			// check if dependency is met
			if ( !this.depend(param, element) )
				return "dependency-mismatch";
			switch( element.nodeName.toLowerCase() ) {
			case 'select':
				var options = jQuery("option:selected", element);
				return options.length > 0 && ( element.type == "select-multiple" || (jQuery.browser.msie && !(options[0].attributes['value'].specified) ? options[0].text : options[0].value).length > 0);
			case 'input':
				if ( this.checkable(element) )
					return this.getLength(value, element) > 0;
			default:
				return value.length > 0;
			}
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/remote
		remote: function(value, element, param) {
			if ( this.optional(element) )
				return "dependency-mismatch";
			
			var previous = this.previousValue(element);
			
			if (!this.settings.messages[element.name] )
				this.settings.messages[element.name] = {};
			this.settings.messages[element.name].remote = typeof previous.message == "function" ? previous.message(value) : previous.message;
			
			if ( previous.old !== value ) {
				previous.old = value;
				var validator = this;
				this.startRequest(element);
				var data = {};
				data[element.name] = value;
				jQuery.ajax({
					url: param,
					mode: "abort",
					port: "validate" + element.name,
					dataType: "json",
					data: data,
					success: function(response) {
						if ( !response ) {
							var errors = {};
							errors[element.name] =  response || validator.defaultMessage( element, "remote" );
							validator.showErrors(errors);
						} else {
							var submitted = validator.formSubmitted;
							validator.prepareElement(element);
							validator.formSubmitted = submitted;
							validator.successList.push(element);
							validator.showErrors();
						}
						previous.valid = response;
						validator.stopRequest(element, response);
					}
				});
				return "pending";
			} else if( this.pending[element.name] ) {
				return "pending";
			}
			return previous.valid;
		},

		// http://docs.jquery.com/Plugins/Validation/Methods/minlength
		minlength: function(value, element, param) {
			return this.optional(element) || this.getLength(value, element) >= param;
		},
		
		// deprecated, to be removed in 1.3
		minLength: function(value, element, param) {
			return jQuery.validator.methods.minlength.apply(this, arguments);
		},
	
		// http://docs.jquery.com/Plugins/Validation/Methods/maxlength
		maxlength: function(value, element, param) {
			return this.optional(element) || this.getLength(value, element) <= param;
		},
		
		// deprecated, to be removed in 1.3
		maxLength: function(value, element, param) {
			return jQuery.validator.methods.maxlength.apply(this, arguments);
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/rangelength
		rangelength: function(value, element, param) {
			var length = this.getLength(value, element);
			return this.optional(element) || ( length >= param[0] && length <= param[1] );
		},
		
		// deprecated, to be removed in 1.3
		rangeLength: function(value, element, param) {
			return jQuery.validator.methods.rangelength.apply(this, arguments);
		},
	
		// http://docs.jquery.com/Plugins/Validation/Methods/min
		min: function( value, element, param ) {
			return this.optional(element) || value >= param;
		},
		
		// deprecated, to be removed in 1.3
		minValue: function() {
			return jQuery.validator.methods.min.apply(this, arguments);
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/max
		max: function( value, element, param ) {
			return this.optional(element) || value <= param;
		},
		
		// deprecated, to be removed in 1.3
		maxValue: function() {
			return jQuery.validator.methods.max.apply(this, arguments);
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/range
		range: function( value, element, param ) {
			return this.optional(element) || ( value >= param[0] && value <= param[1] );
		},
		
		// deprecated, to be removed in 1.3
		rangeValue: function() {
			return jQuery.validator.methods.range.apply(this, arguments);
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/email
		email: function(value, element) {
			// contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
			return this.optional(element) || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(value);
		},
	
		// http://docs.jquery.com/Plugins/Validation/Methods/url
		url: function(value, element) {
			// contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
			return this.optional(element) || /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value);
		},
        
		// http://docs.jquery.com/Plugins/Validation/Methods/date
		date: function(value, element) {
			return this.optional(element) || !/Invalid|NaN/.test(new Date(value));
		},
	
		// http://docs.jquery.com/Plugins/Validation/Methods/dateISO
		dateISO: function(value, element) {
			return this.optional(element) || /^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(value);
		},
	
		// http://docs.jquery.com/Plugins/Validation/Methods/dateDE
		dateDE: function(value, element) {
			return this.optional(element) || /^\d\d?\.\d\d?\.\d\d\d?\d?$/.test(value);
		},
	
		// http://docs.jquery.com/Plugins/Validation/Methods/number
		number: function(value, element) {
			return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
		},
	
		// http://docs.jquery.com/Plugins/Validation/Methods/numberDE
		numberDE: function(value, element) {
			return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:\.\d{3})+)(?:,\d+)?$/.test(value);
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/digits
		digits: function(value, element) {
			return this.optional(element) || /^\d+$/.test(value);
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/creditcard
		// based on http://en.wikipedia.org/wiki/Luhn
		creditcard: function(value, element) {
			if ( this.optional(element) )
				return "dependency-mismatch";
			var nCheck = 0,
				nDigit = 0,
				bEven = false;

			value = value.replace(/\D/g, "");

			for (n = value.length - 1; n >= 0; n--) {
				var cDigit = value.charAt(n);
				var nDigit = parseInt(cDigit, 10);
				if (bEven) {
					if ((nDigit *= 2) > 9)
						nDigit -= 9;
				}
				nCheck += nDigit;
				bEven = !bEven;
			}

			return (nCheck % 10) == 0;
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/accept
		accept: function(value, element, param) {
			param = typeof param == "string" ? param : "png|jpe?g|gif";
			return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i")); 
		},
		
		// http://docs.jquery.com/Plugins/Validation/Methods/equalTo
		equalTo: function(value, element, param) {
			return value == jQuery(param).val();
		}
		
	}
	
});

// ajax mode: abort
// usage: $.ajax({ mode: "abort"[, port: "uniqueport"]});
// if mode:"abort" is used, the previous request on that port (port can be undefined) is aborted via XMLHttpRequest.abort() 
;(function($) {
	var ajax = $.ajax;
	var pendingRequests = {};
	$.ajax = function(settings) {
		// create settings for compatibility with ajaxSetup
		settings = jQuery.extend(settings, jQuery.extend({}, jQuery.ajaxSettings, settings));
		var port = settings.port;
		if (settings.mode == "abort") {
			if ( pendingRequests[port] ) {
				pendingRequests[port].abort();
			}
			return pendingRequests[port] = ajax.apply(this, arguments);
		}
		return ajax.apply(this, arguments);
	};
})(jQuery);

// provides cross-browser focusin and focusout events
// IE has native support, in other browsers, use event caputuring (neither bubbles)

// provides delegate(type: String, delegate: Selector, handler: Callback) plugin for easier event delegation
// handler is only called when $(event.target).is(delegate), in the scope of the jQuery-object for event.target 

// provides triggerEvent(type: String, target: Element) to trigger delegated events
;(function($) {
	$.extend($.event.special, {
		focusin: {
			setup: function() {
				if ($.browser.msie)
					return false;
				this.addEventListener("focus", $.event.special.focusin.handler, true);
			},
			teardown: function() {
				if ($.browser.msie)
					return false;
				this.removeEventListener("focus", $.event.special.focusin.handler, true);
			},
			handler: function(event) {
				var args = Array.prototype.slice.call( arguments, 1 );
				args.unshift($.extend($.event.fix(event), { type: "focusin" }));
				return $.event.handle.apply(this, args);
			}
		},
		focusout: {
			setup: function() {
				if ($.browser.msie)
					return false;
				this.addEventListener("blur", $.event.special.focusout.handler, true);
			},
			teardown: function() {
				if ($.browser.msie)
					return false;
				this.removeEventListener("blur", $.event.special.focusout.handler, true);
			},
			handler: function(event) {
				var args = Array.prototype.slice.call( arguments, 1 );
				args.unshift($.extend($.event.fix(event), { type: "focusout" }));
				return $.event.handle.apply(this, args);
			}
		}
	});
	$.extend($.fn, {
		delegate: function(type, delegate, handler) {
			return this.bind(type, function(event) {
				var target = $(event.target);
				if (target.is(delegate)) {
					return handler.apply(target, arguments);
				}
			});
		},
		triggerEvent: function(type, target) {
			return this.triggerHandler(type, [jQuery.event.fix({ type: type, target: target })]);
		}
	})
})(jQuery);
