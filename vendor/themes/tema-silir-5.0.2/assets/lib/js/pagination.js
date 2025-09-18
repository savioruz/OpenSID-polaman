function initPagination(data) {
  const paginationContainer = $("#pagination-container");
  const paginationInfo = $("#pagination-info");
  const paginationList = $("#pagination-list");
  let paginationInfoHTML = '';
  let paginationListHTML = ''

  paginationContainer.show();
  paginationInfo.empty();
  paginationList.empty();

  const totalPages = parseInt(data.meta.pagination.total_pages);
  const currentPage = parseInt(data.meta.pagination.current_page);

  if (totalPages > 1) {
    paginationInfoHTML = `Halaman ${currentPage} dari ${totalPages}`;
    paginationListHTML = `<nav aria-label="nomor halaman"><ul class="pagination mt-1 mb-5">`;

    paginationListHTML += `<li class="page-item">
                            <button class="pagination-link" data-page="1">
                              <i class="ti ti-chevrons-left icon-base inline-block"></i>
                            </button>
                          </li>`;

    if (currentPage > 1) {
      paginationListHTML += `<li class="page-item">
                              <button class="pagination-link" data-page="${currentPage - 1}">
                                <i class="ti ti-chevron-left icon-base inline-block"></i>
                              </button>
                            </li>`;
    }

    for (let i = 1; i <= totalPages; i++) {
      paginationListHTML += `<li class="page-item">
                              <button class="pagination-link ${i === currentPage ? "is-active" : ""}" data-page="${i}">
                                  ${i}
                              </button>
                            </li>`;
    }

    if (currentPage < totalPages) {
      paginationListHTML += `<li class="page-item">
                              <button class="pagination-link" data-page="${currentPage + 1}">
                                  <i class="ti ti-chevron-right icon-base inline-block"></i>
                              </button>
                            </li>`;
    }

    paginationListHTML += `<li class="page-item">
                            <button class="pagination-link" data-page="${totalPages}">
                                <i class="ti ti-chevrons-right icon-base inline-block"></i>
                            </button>
                          </li>`;

    paginationListHTML += `</ul></nav>`;

  }

  paginationContainer.html(paginationListHTML);
  paginationInfo.text(paginationInfoHTML);
}