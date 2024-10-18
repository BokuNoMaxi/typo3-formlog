import $ from 'jquery';
import moment from 'TYPO3/CMS/Formlog/moment';
import settings from '../Settings.js';
import 'TYPO3/CMS/Formlog/daterangepicker/daterangepicker';

$(function() {
  var $filterForm = $("#filter-form");
  var $dateFilterButton = $('#submissiondate-filter');
  var $startDateField = $($dateFilterButton.data('startDateField'));
  var $endDateField = $($dateFilterButton.data('endDateField'));
  var w3cDateFormat = 'YYYY-MM-DDTHH:mm:ssZ'; // See PHP DateTime::W3C
  var translations = $dateFilterButton.data('translations');
  var ranges = {
    last30days: [moment().subtract(29, 'days'), moment()],
    lastYear: [moment().subtract(1, 'year').add(1,'day'), moment()],
  };
  var localizedRanges = {};

  for (var range in ranges) {
    var localizedRange = range;

    if (range in translations.ranges) {
      localizedRange = translations.ranges[range];
    }

    localizedRanges[localizedRange] = ranges[range];
  }

  moment.locale(settings.language);

  $dateFilterButton.daterangepicker(
    {
      locale: translations.labels,
      startDate: $startDateField.val() ? moment($startDateField.val(), w3cDateFormat) : undefined,
      endDate: $endDateField.val() ? moment($endDateField.val(), w3cDateFormat) : undefined,
      ranges: localizedRanges,
      showCustomRangeLabel: true,
    },
    function (startDate, endDate) {
      $startDateField.val(startDate.format(w3cDateFormat));
      $endDateField.val(endDate.format(w3cDateFormat));

      $filterForm.submit();
    },
  );
});
