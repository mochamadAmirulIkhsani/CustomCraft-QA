describe("register succesfull", () => {
    it("register success", () => {
        cy.visit("https://ccqa.amirulikhsani.my.id/admin/register");
        cy.get('input[type="text"]').type("Test User");
        cy.get('input[type="email"]').type("usertest1@gmail.com");
        cy.get("#data\\.password").type("user123");
        cy.get("#data\\.passwordConfirmation").type("user123");
        cy.get("#data\\.role").select("seller");

        cy.get('button[type="submit"]').click();
    });
});

describe("register failed because wrong email format", () => {
    it("register failed because wrong email format", () => {
        cy.visit("https://ccqa.amirulikhsani.my.id/admin/register");
        cy.get('input[type="text"]').type("Test User");
        cy.get('input[type="email"]').type("testuser");
        cy.get("#data\\.password").type("user123");
        cy.get("#data\\.passwordConfirmation").type("user123");
        cy.get("#data\\.role").select("seller");

        cy.get('button[type="submit"]').click();
    });
});

describe("register failed because password mismatch", () => {
    it("register failed because password mismatch", () => {
        cy.visit("https://ccqa.amirulikhsani.my.id/admin/register");
        cy.get('input[type="text"]').type("Test User");
        cy.get('input[type="email"]').type("usertest1@gmail.com");
        cy.get("#data\\.password").type("user123");
        cy.get("#data\\.passwordConfirmation").type("wrongpassword");
        cy.get("#data\\.role").select("seller");

        cy.get('button[type="submit"]').click();
    });
});

describe("register failed because email already used", () => {
    it("register failed because email already used", () => {
        cy.visit("https://ccqa.amirulikhsani.my.id/admin/register");
        cy.get('input[type="text"]').type("Test User");
        cy.get('input[type="email"]').type("admin@gmail.com");
        cy.get("#data\\.password").type("user123");
        cy.get("#data\\.passwordConfirmation").type("user123");
        cy.get("#data\\.role").select("seller");

        cy.get('button[type="submit"]').click();
    });
});

describe("register failed because role not selected", () => {
    it("register failed because role not selected", () => {
        cy.visit("https://ccqa.amirulikhsani.my.id/admin/register");
        cy.get('input[type="text"]').type("Test User");
        cy.get('input[type="email"]').type("usertest1@gmail.com");
        cy.get("#data\\.password").type("user123");
        cy.get("#data\\.passwordConfirmation").type("user123");
        cy.get("#data\\.role").select("Select an option");

        cy.get('button[type="submit"]').click();
    });
});
