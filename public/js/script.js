$(document).ready(function() {

    let titles = $('.table-body__title')
    let body   = $('.table-body__body')
    let rows   = $('.table-body__row')

    let order = 'asc';
    titles.bind('click', function(e) {

        let index = $(e.target).data('index');

        rows.sort(function(row1, row2) {

            let val1 = $($(row1).children()[index]).text()
            let val2 = $($(row2).children()[index]).text()

            if (order == 'asc') {
                return val1 == val2 ? 0 : (val1 > val2 ? 1 : -1)
            }

            if (order == 'desc') {
                return val1 == val2 ? 0 : (val1 > val2 ? -1 : 1)
            }

        })

        body.html(rows)

        order = (order == 'asc') ? 'desc' : 'asc'

    })

})
