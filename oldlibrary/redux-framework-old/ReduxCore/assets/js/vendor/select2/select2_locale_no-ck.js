/**
 * Select2 Norwegian translation.
 *
 * Author: Bamboothemes Torgeir Veimo <torgeir.veimo@gmail.com>
 */(function(e){"use strict";e.extend(e.fn.select2.defaults,{formatNoMatches:function(){return"Ingen treff"},formatInputTooShort:function(e,t){var n=t-e.length;return"Vennligst skriv inn "+n+(n>1?" flere tegn":" tegn til")},formatInputTooLong:function(e,t){var n=e.length-t;return"Vennligst fjern "+n+" tegn"},formatSelectionTooBig:function(e){return"Du kan velge maks "+e+" elementer"},formatLoadMore:function(e){return"Laster flere resultater..."},formatSearching:function(){return"Søker..."}})})(jQuery);