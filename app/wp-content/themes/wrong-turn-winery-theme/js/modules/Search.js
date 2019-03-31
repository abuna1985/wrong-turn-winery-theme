import makeRequest from './makeRequest';

class Search {
  // 1. describe  and create/initiate our object
  constructor() {
    this.body = document.querySelector('body');
    this.addSearchHTML();
    this.resultsDiv = document.querySelector('#search-overlay__results');
    this.searchOverlay = document.querySelector('.search-overlay');
    this.searchField = document.querySelector('#search-term');
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }

  // 2. events
  events() {
    document.addEventListener('click', event => {
      if (event.target.closest('.js-search-trigger')) {
        event.preventDefault();
        this.openOverlay();
        event.stopPropagation();
      }

      if (event.target.closest('.search-overlay__close')) {
        this.closeOverlay();
      }

      return false;
    });

    document.addEventListener('keydown', event => {
      const inputs = [...document.querySelectorAll('input'), ...document.querySelectorAll('textarea')];
      let inputsHaveFocus = false;
      inputs.forEach(input=> {
        if (input === document.activeElement) {
          inputsHaveFocus = true;
        }
      })
      if(event.keyCode === 83 && !this.isOverlayOpen  && !inputsHaveFocus) {
        event.preventDefault();
        this.openOverlay();
        event.stopPropagation();
      }

      if(event.keyCode === 27 && this.isOverlayOpen) {
        this.closeOverlay();
      }

      return false;
    });

    document.addEventListener('keyup', event => {
      if (event.target.closest('#search-term')) {
        this.typingLogic();
      }

      return false;
    });
  }

  // 3. methods (functions)
  typingLogic() {
    if (this.searchField.value !== this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
          this.isSpinnerVisible = true;
        }

        this.typingTimer = setTimeout(this.getResults.bind(this), 750);

      } else {
        this.resultsDiv.innerHTML = '';
        this.isSpinnerVisible = false;
      }
    }
    
    this.previousValue = this.searchField.value;
    console.log(this.previousValue);
  }

  getResults() {
    makeRequest({
      method: 'GET',
      url: `${wineryData.root_url}/wp-json/winery/v1/search?term=${this.searchField.value}`
    })
      .then(data => {
        let matches = JSON.parse(data);
        this.resultsDiv.innerHTML = `
          <div class="row">
            <div class="one-third">
              <h2 class="search-overlay__section-title">General Information</h2>
              ${matches.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                ${matches.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
              ${matches.generalInfo.length ? '</ul>' : ''}
            </div>
            <div class="one-third">
              <h2 class="search-overlay__section-title">Wines</h2>
              ${matches.wines.length ? '<ul class="link-list min-list">' : `<p>No wines matches that search. <a href="${wineryData.root_url}/wines">View all wines</a></p>`}
                ${matches.wines.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType === 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
              ${matches.wines.length ? '</ul>' : ''}
              <h2 class="search-overlay__section-title">Staff</h2>
              ${matches.staff.length ? '<ul class="staff-cards">' : `<p>No staff matches that search.</p>`}
                ${matches.staff.map(item => `
                <li class="staff-card__list-item">
                 <a class="staff-card" href=${item.permalink}">
                  <img class="staff-card__image" src="${item.image}">
                  <span class="staff-card__name">${item.title}</span>
                 </a>
              </li>
                `).join('')}
              ${matches.staff.length ? '</ul>' : ''}
            </div>
            <div class="one-third">
              <h2 class="search-overlay__section-title">Locations</h2>
              ${matches.locations.length ? '<ul class="link-list min-list">' : `<p>No locations matches that search. <a href="${wineryData.root_url}/locations">View all locations</a></p>`}
                ${matches.locations.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType === 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
              ${matches.locations.length ? '</ul>' : ''}
              <h2 class="search-overlay__section-title">Events</h2>
              ${matches.events.length ? '' : `<p>No events matches that search. <a href="${wineryData.root_url}/events">View all events</a></p>`}
              ${matches.events.map(item => `
                <div class="event-summary">
                  <a class="event-summary__date t-center" href="${item.permalink}">
                    <span class="event-summary__month">${item.month}</span>
                    <span class="event-summary__day">${item.day}</span>  
                  </a>
                  <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                    <p>${item.description} <a href="${item.permalink}" class="nu gray">Learn more</a></p>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>
        `;
        this.isSpinnerVisible = false;
      })
      .catch(error => {
        this.resultsDiv.innerHTML = '<p>Unexpected error. Please try again.</p>'
        console.log('Something went wrong', error);
      });

  }

  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active');
    this.body.classList.add('body-no-scroll');
    this.searchField.value = '';
    setTimeout(() => this.searchField.focus(), 301);
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active');
    this.body.classList.remove('body-no-scroll');
    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    this.body.insertAdjacentHTML('beforeend', `
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        <div class="container">
          <div id="search-overlay__results"></div>
        </div>
      </div>
    `);
  }
}


export default Search;