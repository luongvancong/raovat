"use strict";

$(function() {
    var keywordSuggestBloodhound = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // prefetch: '/ajax/products.json',
        remote: {
            url: '/ajax/search-products.json/%QUERY',
            wildcard: '%QUERY'
        }
    });

    $('.input-search').typeahead(null, {
        name : 'products',
        display: 'keyword',
        highlight: true,
        source : keywordSuggestBloodhound,
        templates: {
            suggestion: Handlebars.compile('<div>{{keyword}}</div>')
        }
    });

    // $('a').click(function() {
    //     var $this = $(this);
    //     $this.attr('target', '_blank');
    // });
});