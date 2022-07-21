<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script>
    const right = document.querySelector('.col-right-sidebar')
    const navbar = document.querySelector('.col-navbar')
    const cover = document.querySelector('.screen-cover')

    const sidebar_items = document.querySelectorAll('.sidebar-item')

    function toggleNavbar() {
        navbar.classList.toggle('appear')
        cover.classList.toggle('d-none')
    }

    function toggleRightSidebar() {
        right.classList.toggle('appear')
        cover.classList.toggle('d-none')
    }

    cover.addEventListener('click', e => {
        cover.classList.add('d-none')
        right.classList.remove('appear')
        navbar.classList.remove('appear')
    })

    function toggleActive(e) {
        sidebar_items.forEach(function(v, k) {
            v.classList.remove('active')
        })
        e.closest('.sidebar-item').classList.add('active')
    }

    function increaseNumber(e) {
        let inp = e.closest('div').querySelector('.input-number')
        let current = inp.value

        inp.value = ++current
    }

    function decreaseNumber(e) {
        let inp = e.closest('div').querySelector('.input-number')
        let current = inp.value

        if (current !== "0") {
            inp.value = --current
        }
    }

    function handleSearchMyPost() {
        valueInputSearch = this.value

        var ajax = new XMLHttpRequest();
        ajax.open("POST", "/dashboard/api/search-myPost", true);

        ajax.setRequestHeader("Content-Type", "application/json");
        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
            }
        };

        var data = {
            key: valueInputSearch,
        };

        ajax.send(JSON.stringify(data));

    }

    const searchMyPost = document.getElementById("searchMyPost")
    searchMyPost.addEventListener('keyup', handleSearchMyPost);
</script>
</body>

</html>