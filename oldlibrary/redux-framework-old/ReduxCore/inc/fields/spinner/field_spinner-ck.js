/* global redux_change */jQuery(document).ready(function(){function e(e,t,n){if(!t.hasClass("spinnerInputChange"))return;t.removeClass("spinnerInputChange");e===""||e===null?e=n.min:e>=parseInt(n.max)?e=n.max:e<=parseInt(n.min)?e=n.min:e=Math.round(e/n.step)*n.step;jQuery("#"+n.id).val(e)}jQuery(".redux_spinner").each(function(){var e=redux.spinner[jQuery(this).attr("rel")];jQuery("#"+e.id).spinner({value:parseInt(e.val,null),min:parseInt(e.min,null),max:parseInt(e.max,null),step:parseInt(e.step,null),range:"min",slide:function(t,n){var r=jQuery("#"+e.id);r.val(n.value);redux_change(r)}});var t=!1;parseInt(e.min,null)<0&&(t=!0);jQuery("#"+e.id).numeric({allowMinus:t,min:e.min,max:e.max})});jQuery(".spinner-input").keyup(function(){jQuery(this).addClass("spinnerInputChange")});jQuery(".spinner-input").blur(function(){});jQuery(".spinner-input").focus(function(){e(jQuery(this).val(),jQuery(this),redux.spinner[jQuery(this).attr("id")])});jQuery(".spinner-input").typeWatch({callback:function(t){e(t,jQuery(this),redux.spinner[jQuery(this).attr("id")])},wait:500,highlight:!1,captureLength:1})});