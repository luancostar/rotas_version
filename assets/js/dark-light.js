document.addEventListener('DOMContentLoaded', function () {
  const layoutModeRadios = document.querySelectorAll('input[name="layout-mode"]');
  
  // Recupere o valor do modo de layout do armazenamento local ao carregar a página
  const savedLayoutMode = localStorage.getItem('layoutMode');
  if (savedLayoutMode) {
      // Se houver um valor salvo, marque o radio button correspondente
      document.querySelector(`input[value="${savedLayoutMode}"]`).checked = true;

      // Use os valores salvos ao carregar a página
      applyLayout(savedLayoutMode);
  }

  // Adicione um ouvinte de evento para os botões de rádio
  layoutModeRadios.forEach((input) => {
      input.addEventListener('change', function () {
          // Armazene o modo de layout selecionado no armazenamento local
          localStorage.setItem('layoutMode', this.value);

          // Use e salve os valores conforme necessário
          applyLayout(this.value);
      });
  });

  function applyLayout(layoutMode) {
      // Use os valores conforme necessário em seu código
      const topbarValue = layoutMode === 'light' ? 'light' : 'dark';
      const sidebarValue = layoutMode === 'light' ? 'light' : 'dark';

      console.log('data-topbar:', topbarValue);
      console.log('data-layout-mode:', layoutMode);
      console.log('data-sidebar:', sidebarValue);

      // Exemplo de aplicação desses valores
      document.body.setAttribute('data-topbar', topbarValue);
      document.body.setAttribute('data-layout-mode', layoutMode);
      document.body.setAttribute('data-sidebar', sidebarValue);
  }
});