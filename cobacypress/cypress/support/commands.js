// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************

import "cypress-file-upload";

// Custom login command with session
Cypress.Commands.add("login", (email, password) => {
    cy.session(
        [email, password],
        () => {
            cy.visit("https://ccqa.amirulikhsani.my.id/admin/login");
            cy.get('input[type="email"]').type(email);
            cy.get('input[type="password"]').type(password);
            cy.get('input[type="checkbox"]').check();
            cy.get('button[type="submit"]').click();
            cy.url().should("include", "/admin");
            cy.wait(1000);
        },
        {
            validate() {
                cy.visit("https://ccqa.amirulikhsani.my.id/admin");
                cy.url().should("include", "/admin");
            },
        }
    );
});

//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })
