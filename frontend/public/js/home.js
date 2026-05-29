function abrirModalServico(
        nome,
        prestador,
        descricao,
        prazo,
        preco,
        localizacao,
        foto
    ) {

        document.getElementById('modal-titulo').innerText = nome;

        document.getElementById('modal-prestador').innerText = prestador;

        document.getElementById('modal-descricao').innerText = descricao;

        document.getElementById('modal-prazo').innerText = prazo + ' dias';

        document.getElementById('modal-preco').innerText =
            'R$ ' + parseFloat(preco).toFixed(2);

        document.getElementById('modal-localizacao').innerText =
            localizacao;

        document.getElementById('modal-foto').src = foto;

        document.getElementById('modalServico').style.display = 'flex';
    }

    function fecharModalServico() {

        document.getElementById('modalServico').style.display = 'none';
    }

    function toggleCategorias() {
        const dropdown = document.getElementById('categoriasDropdown');
        dropdown.classList.toggle('ativo');
    }

    function toggleExpandir(event) {
        event.stopPropagation();

        const extra = document.getElementById('categoriasExtra');
        const icon = document.getElementById('icon-expand');

        extra.classList.toggle('ativo');
        icon.classList.toggle('fa-rotate-180');
    }


    document.addEventListener('click', function(e) {
        const menu = document.getElementById('categoriasDropdown');
        const btn = document.querySelector('.btn-categorias');

        if (!menu.contains(e.target) && !btn.contains(e.target)) {
            menu.classList.remove('ativo');
        }
    });


    const searchInput = document.getElementById("searchInput");

const cards = document.querySelectorAll(".card-servico");

searchInput.addEventListener("input", () => {

    const value = searchInput.value
        .toLowerCase()
        .trim();

    cards.forEach(card => {

        const nome =
            card.dataset.nome;

        const prestador =
            card.dataset.prestador;

        const descricao =
            card.dataset.descricao;

        const match =
            nome.includes(value) ||
            prestador.includes(value) ||
            descricao.includes(value);

        if(value === "" || match){

            card.style.display = "flex";

            requestAnimationFrame(() => {
                card.classList.remove("hidden-card");
            });

        }else{

            card.classList.add("hidden-card");

            setTimeout(() => {

                if(card.classList.contains("hidden-card")){
                    card.style.display = "none";
                }

            }, 120);

        }

    });

});