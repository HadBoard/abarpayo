const defaults = {
    height: 115,
    width: 330
};

const template = ({id, photo, name, post, phone, link}) => (`
    <div class="dhx-diagram-demo_personal-card">
      <div class="dhx-diagram-demo_personal-card__container dhx-diagram-demo_personal-card__img-container">
             <img src="${photo}" alt="${name}-${post}"></img>
      </div>
      <div class="dhx-diagram-demo_personal-card__container">
            <h3>${name}</h3>
            <p>${post}</p>
            <span class="dhx-diagram-demo_personal-card__info">
                <i class="mdi mdi-cellphone-android"></i>
                <p>${phone}</p>
            </span>
            <span class="dhx-diagram-demo_personal-card__info">
                <i class="mdi mdi-email-outline"></i>
                <a href="marketer-list.php?edit=${id    }" target="_blank">${link}</a>
            </span>
      </div>
    </div>
  `);

