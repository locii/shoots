/**
 * Select2 <Language> translation.
 * 
 * Author: Bamboothemes Swen Mun <longfinfunnel@gmail.com>
 */(function(e){"use strict";e.extend(e.fn.select2.defaults,{formatNoMatches:function(){return"결과 없음"},formatInputTooShort:function(e,t){var n=t-e.length;return"너무 짧습니다. "+n+"글자 더 입력해주세요."},formatInputTooLong:function(e,t){var n=e.length-t;return"너무 깁니다. "+n+"글자 지워주세요."},formatSelectionTooBig:function(e){return"최대 "+e+"개까지만 선택하실 수 있습니다."},formatLoadMore:function(e){return"불러오는 중…"},formatSearching:function(){return"검색 중…"}})})(jQuery);