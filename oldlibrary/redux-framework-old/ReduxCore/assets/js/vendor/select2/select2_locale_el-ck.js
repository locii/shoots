/**
 * Select2 <Language> translation.
 * 
 * Author: Bamboothemes Your Name <your@email>
 */(function(e){"use strict";e.extend(e.fn.select2.defaults,{formatNoMatches:function(){return"Δεν βρέθηκαν αποτελέσματα"},formatInputTooShort:function(e,t){var n=t-e.length;return"Παρακαλούμε εισάγετε "+n+" περισσότερο"+(n==1?"":"υς")+" χαρακτήρ"+(n==1?"α":"ες")},formatInputTooLong:function(e,t){var n=e.length-t;return"Παρακαλούμε διαγράψτε "+n+" χαρακτήρ"+(n==1?"α":"ες")},formatSelectionTooBig:function(e){return"Μπορείτε να επιλέξετε μόνο "+e+" αντικείμεν"+(e==1?"ο":"α")},formatLoadMore:function(e){return"Φόρτωση περισσότερων..."},formatSearching:function(){return"Αναζήτηση..."}})})(jQuery);