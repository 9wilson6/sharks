// Bootstrap4 + FontAwesome Icon
export default {
    table: {
        tableWrapper: '',
        tableHeaderClass: 'mb-0',
        tableBodyClass: 'mb-0',
        tableClass: 'table table-bordered table-striped',
        loadingClass: 'loading',
        ascendingIcon: 'fa fa-chevron-up',
        descendingIcon: 'fa fa-chevron-down',
        ascendingClass: 'sorted-asc',
        descendingClass: 'sorted-desc',
        sortableIcon: 'fa fa-sort',
        detailRowClass: 'vuetable-detail-row',
        handleIcon: 'fa fa-bars text-secondary',
        renderIcon(classes, options) {
            return `<i class="${classes.join(' ')}"></span>`
        }
    },
    pagination: {
        wrapperClass: 'ui right floated pagination menu',
        activeClass: 'active large',
        disabledClass: 'disabled',
        pageClass: 'item',
        linkClass: 'icon item',
        paginationClass: 'ui bottom attached segment grid',
        paginationInfoClass: 'left floated left aligned six wide column',
        dropdownClass: 'ui search dropdown',
        icons: {
            first: 'fa fa-angle-double-left',
            prev: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            last: 'fa fa-angle-double-right',
        }
    },

    paginationInfo: {
        infoClass: 'left floated left aligned six wide column',
    }
}