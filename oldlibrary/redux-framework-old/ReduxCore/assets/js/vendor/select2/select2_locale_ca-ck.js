/**
 * Select2 Catalan translation.
 * 
 * Author: Bamboothemes David Planella <david.planella@gmail.com>
 */(function(e){"use strict";e.extend(e.fn.select2.defaults,{formatNoMatches:function(){return"No s'ha trobat cap coincidència"},formatInputTooShort:function(e,t){var n=t-e.length;return"Introduïu "+n+" caràcter"+(n==1?"":"s")+" més"},formatInputTooLong:function(e,t){var n=e.length-t;return"Introduïu "+n+" caràcter"+(n==1?"":"s")+"menys"},formatSelectionTooBig:function(e){return"Només podeu seleccionar "+e+" element"+(e==1?"":"s")},formatLoadMore:function(e){return"S'estan carregant més resultats..."},formatSearching:function(){return"S'està cercant..."}})})(jQuery);