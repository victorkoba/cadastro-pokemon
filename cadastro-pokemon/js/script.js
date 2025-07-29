// Abrir/fechar menu ao clicar no botão
function toggleMenu() {
  const menu = document.getElementById("menuLateral");
  menu.classList.toggle("ativo");
}

// Fechar o menu ao clicar fora
document.addEventListener("click", function(event) {
  const menu = document.getElementById("menuLateral");
  const botao = document.querySelector(".hamburguer");

  // Se o menu estiver aberto E o clique for fora do menu e fora do botão
  if (menu.classList.contains("ativo") && !menu.contains(event.target) && !botao.contains(event.target)) {
    menu.classList.remove("ativo");
  }
});
