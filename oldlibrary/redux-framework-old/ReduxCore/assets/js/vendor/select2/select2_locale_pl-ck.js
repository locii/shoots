/**
 * Select2 Polish translation.
 * 
 * Author: Bamboothemes Jan Kondratowicz <jan@kondratowicz.pl>
 */(function(e){"use strict";var t=function(e){return e==1?"":e%100>1&&e%100<5||e%100>20&&e%10>1&&e%10<5?"i":"ów"};e.extend(e.fn.select2.defaults,{formatNoMatches:function(){return"Brak wyników."},formatInputTooShort:function(e,n){var r=n-e.length;return"Wpisz jeszcze "+r+" znak"+t(r)+"."},formatInputTooLong:function(e,n){var r=e.length-n;return"Wpisana fraza jest za długa o "+r+" znak"+t(r)+"."},formatSelectionTooBig:function(e){return"Możesz zaznaczyć najwyżej "+e+" element"+t(e)+"."},formatLoadMore:function(e){return"Ładowanie wyników..."},formatSearching:function(){return"Szukanie..."}})})(jQuery);