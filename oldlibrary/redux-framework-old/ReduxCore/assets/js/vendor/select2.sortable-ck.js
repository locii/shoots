/**
 * jQuery Select2 Sortable
 * - enable select2 to be sortable via normal select element
 * 
 * author      : Vafour
 * inspired by : jQuery Chosen Sortable (https://github.com/mrhenry/jquery-chosen-sortable)
 * License     : GPL
 */(function(e){e.fn.extend({select2SortableOrder:function(){var t=this.filter("[multiple]");t.each(function(){var t=e(this);if(typeof t.data("select2")!="object")return!1;var n=t.siblings(".select2-container"),r=[],i;t.find("option").each(function(){!this.selected&&r.push(this)});i=e(n.find('.select2-choices li[class!="select2-search-field"]').map(function(){if(!this)return undefined;var n=e(this).data("select2Data").id;return t.find('option[value="'+n+'"]')[0]}));i.push.apply(i,r);t.children().remove();t.append(i)});return t},select2Sortable:function(){var t=Array.prototype.slice.call(arguments,0);$this=this.filter("[multiple]"),validMethods=["destroy"];if(t.length===0||typeof t[0]=="object"){var n={bindOrder:"formSubmit",sortableOptions:{placeholder:"ui-state-highlight",items:"li:not(.select2-search-field)",tolerance:"pointer"}},r=e.extend(n,t[0]);typeof $this.data("select2")!="object"&&$this.select2();$this.each(function(){var t=e(this),n=t.siblings(".select2-container").find(".select2-choices");n.sortable(r.sortableOptions);switch(r.bindOrder){case"sortableStop":n.on("sortstop.select2sortable",function(e,n){t.select2SortableOrder()});t.on("change",function(t){e(this).select2SortableOrder()});break;default:t.closest("form").unbind("submit.select2sortable").on("submit.select2sortable",function(){t.select2SortableOrder()})}})}else if(typeof (t[0]==="string")){if(e.inArray(t[0],validMethods)==-1)throw"Unknown method: "+t[0];t[0]==="destroy"&&$this.select2SortableDestroy()}return $this},select2SortableDestroy:function(){var t=this.filter("[multiple]");t.each(function(){var t=e(this),n=t.parent().find(".select2-choices");t.closest("form").unbind("submit.select2sortable");n.unbind("sortstop.select2sortable");n.sortable("destroy")});return t}})})(jQuery);