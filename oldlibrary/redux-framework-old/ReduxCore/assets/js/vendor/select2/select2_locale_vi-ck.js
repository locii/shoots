/**
 * Select2 Vietnamese translation.
 * 
 * Author: Bamboothemes Long Nguyen <olragon@gmail.com>
 */(function(e){"use strict";e.extend(e.fn.select2.defaults,{formatNoMatches:function(){return"Không tìm thấy kết quả"},formatInputTooShort:function(e,t){var n=t-e.length;return"Vui lòng nhập nhiều hơn "+n+" ký tự"+(n==1?"":"s")},formatInputTooLong:function(e,t){var n=e.length-t;return"Vui lòng nhập ít hơn "+n+" ký tự"+(n==1?"":"s")},formatSelectionTooBig:function(e){return"Chỉ có thể chọn được "+e+" tùy chọn"+(e==1?"":"s")},formatLoadMore:function(e){return"Đang lấy thêm kết quả..."},formatSearching:function(){return"Đang tìm..."}})})(jQuery);