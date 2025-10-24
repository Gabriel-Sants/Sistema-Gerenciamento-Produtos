// resources/js/dashboard.js

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

document.addEventListener("click", function (e) {
    const card = e.target.closest(".card-link");
    if (!card) return;

    const url = card.dataset.url;
    const container = document.getElementById("dashboard-content");
    container.innerHTML = "<p class='text-gray-400'>Carregando...</p>";

    fetch(url, {
        headers: { "X-Requested-With": "XMLHttpRequest" },
    })
        .then((response) => response.text())
        .then((html) => {
            container.innerHTML = html;
            initProdutoEventos(); // reaplica eventos do form
        })
        .catch((err) => {
            container.innerHTML =
                "<p class='text-red-500'>Erro ao carregar.</p>";
            console.error(err);
        });
});

function initProdutoEventos() {
    initAddProduto();
    initEditProduto();
    initDeleteProduto();
}

function initAddProduto() {
    const novoBtn = document.getElementById("btnNovoProduto");

    if (novoBtn) {
        novoBtn.addEventListener("click", function () {
            fetch("/produtos/create", {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((response) => response.text())
                .then((html) => {
                    const container =
                        document.getElementById("formularioProduto");
                    container.innerHTML = html;

                    initFormProduto();

                    container.scrollIntoView({
                        behavior: "smooth",
                        block: "center",
                    });
                })
                .catch(() => {
                    document.getElementById("formularioProduto").innerHTML =
                        "<p class='text-red-500'>Erro ao carregar o formulário.</p>";
                });
        });
    }
}

function initEditProduto() {
    const editBtns = document.querySelectorAll(".btnEditarProduto");

    editBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            const produtoId = btn.getAttribute("data-id");
            fetch(`/produtos/${produtoId}/edit`, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
            })
                .then((response) => response.text())
                .then((html) => {
                    const container =
                        document.getElementById("formularioProduto");
                    container.innerHTML = html;

                    initFormProduto();

                    container.scrollIntoView({
                        behavior: "smooth",
                        block: "center",
                    });
                })
                .catch(() => {
                    document.getElementById("formularioProduto").innerHTML =
                        "<p class='text-red-500'>Erro ao carregar o formulário.</p>";
                });
        });
    });
}

function initDeleteProduto() {
    const delForms = document.querySelectorAll(".form-excluir-produto");

    delForms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            if (!confirm("Tem certeza que deseja excluir este produto?")) {
                return;
            }

            const produtoId = form.getAttribute("data-id");
            const url = this.action;
            const token = this.querySelector('input[name="_token"]').value;
            const method = this.querySelector('input[name="_method"]').value;

            fetch(url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": token,
                    "X-Requested-With": "XMLHttpRequest",
                    Accept: "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    const container =
                        document.getElementById("dashboard-content");

                    if (data.success) {
                        container.innerHTML = data.html;

                        alert(data.message);
                    } else {
                        alert("Erro ao excluir o produto!");
                    }

                    initProdutoEventos();
                })
                .catch(() => {
                    document.getElementById("formularioProduto").innerHTML =
                        "<p class='text-red-500'>Erro ao carregar o tabela.</p>";
                });
        });
    });
}

function initFormProduto() {
    const form = document.getElementById("formProduto");
    if (!form) return;

    const statusToggle = document.getElementById("statusToggle");
    const statusLabel = document.getElementById("statusLabel");
    console.log("TESTE");

    if (statusToggle) {
        statusToggle.addEventListener("change", function () {
            console.log("TESTE 2");

            statusLabel.textContent = this.checked ? "Ativo" : "Inativo";
        });
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        // Remove mensagens anteriores
        const oldErrors = form.querySelector(".form-errors");
        if (oldErrors) oldErrors.remove();

        const formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then(async (response) => {
                if (response.status === 422) {
                    // pega os erros de validação
                    const data = await response.json();

                    // cria container de erros
                    const errorsDiv = document.createElement("div");
                    errorsDiv.classList.add(
                        "form-errors",
                        "bg-red-100",
                        "text-red-700",
                        "p-3",
                        "rounded",
                        "mb-4"
                    );

                    for (let key in data.errors) {
                        const msgs = data.errors[key].join("<br>");
                        const p = document.createElement("p");
                        p.innerHTML = msgs;
                        errorsDiv.appendChild(p);
                    }

                    // insere no topo do form
                    form.prepend(errorsDiv);

                    throw new Error("Erros de validação");
                }

                if (!response.ok)
                    throw new Error(`Erro HTTP ${response.status}`);

                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    document.getElementById("dashboard-content").innerHTML =
                        data.html;

                    initProdutoEventos();
                    initFormProduto();

                    alert(data.message);
                }
            })
            .catch((err) => console.error(err));
    });
}

function initDashboard() {
    document.querySelectorAll(".card-link").forEach((card) => {
        card.addEventListener("click", function () {
            const url = this.dataset.url;
            const container = document.getElementById("dashboard-content");

            fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((response) => response.text())
                .then((html) => {
                    container.innerHTML = html;

                    // Re-inicializa eventos depois que o conteúdo for carregado
                    initProdutoEventos();
                })
                .catch((err) => {
                    container.innerHTML =
                        "<p class='text-red-500'>Erro ao carregar.</p>";
                    console.error("Erro:", err);
                });
        });
    });
}

document.addEventListener("DOMContentLoaded", initDashboard);
