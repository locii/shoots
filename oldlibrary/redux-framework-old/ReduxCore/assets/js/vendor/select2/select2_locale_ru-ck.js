/**
 * Select2 Russian translation
 */(function(e){"use strict";e.extend(e.fn.select2.defaults,{formatNoMatches:function(){return"Совпадений не найдено"},formatInputTooShort:function(e,t){var n=t-e.length;return"Пожалуйста, введите еще "+n+" символ"+(n==1?"":n>1&&n<5?"а":"ов")},formatInputTooLong:function(e,t){var n=e.length-t;return"Пожалуйста, введите на "+n+" символ"+(n==1?"":n>1&&n<5?"а":"ов")+" меньше"},formatSelectionTooBig:function(e){return"Вы можете выбрать не более "+e+" элемент"+(e==1?"а":"ов")},formatLoadMore:function(e){return"Загрузка данных..."},formatSearching:function(){return"Поиск..."}})})(jQuery);