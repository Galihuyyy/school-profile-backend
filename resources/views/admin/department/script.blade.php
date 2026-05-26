<script>
    function departmentPage(departments = []) {
        return {
            departments,

            search: '',
            sort: 'asc',

            openDelete: false,
            deleteId: null,
            deleteName: '',

            get filteredDepartments() {
                let filtered = this.departments.filter(department => {
                    let keyword = this.search.toLowerCase()

                    return (
                        department.name?.toLowerCase().includes(keyword) ||
                        department.description?.toLowerCase().includes(keyword) ||
                        department.head_teacher?.name?.toLowerCase().includes(keyword)
                    )
                })

                filtered.sort((a, b) => {
                    if (this.sort === 'asc') {
                        return a.name.localeCompare(b.name)
                    }

                    return b.name.localeCompare(a.name)
                })

                return filtered
            }
        }
    }
</script>