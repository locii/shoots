/**
 * Select2 <Language> translation.
 * 
 * Author: Bamboothemes Lubomir Vikev <lubomirvikev@gmail.com>
 */(function(e){"use strict";e.extend(e.fn.select2.defaults,{formatNoMatches:function(){return"Няма намерени съвпадения"},formatInputTooShort:function(e,t){var n=t-e.length;return"Моля въведете още "+n+" символ"+(n==1?"":"а")},formatInputTooLong:function(e,t){var n=e.length-t;return"Моля въведете с "+n+" по-малко символ"+(n==1?"":"а")},formatSelectionTooBig:function(e){return"Можете да направите до "+e+(e==1?" избор":" избора")},formatLoadMore:function(e){return"Зареждат се още..."},formatSearching:function(){return"Търсене..."}})})(jQuery);