/*global jQuery, document*/jQuery(document).ready(function(){jQuery(".ace-editor").each(function(e,t){var n=t,r=jQuery(t).attr("data-editor"),i=ace.edit(r);i.setTheme("ace/theme/"+jQuery(t).attr("data-theme"));i.getSession().setMode("ace/mode/"+jQuery(t).attr("data-mode"));i.on("change",function(e){jQuery("#"+n.id).val(i.getSession().getValue());redux_change(jQuery(t))})})});