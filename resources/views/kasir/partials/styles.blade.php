<style>
    .kasir-page {
        min-height: calc(100vh - 4.75rem);
        padding: 1.75rem;
        background:
            radial-gradient(circle at 8% 8%, rgba(230, 148, 69, .16), transparent 20rem),
            linear-gradient(135deg, #fffaf3 0%, #f8efe4 52%, #f6eadc 100%);
        color: #2f2117;
    }

    .kasir-wrap {
        width: min(100%, 1280px);
        margin: 0 auto;
    }

    .kasir-head {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .kasir-kicker {
        margin: 0 0 .35rem;
        color: #9a6b45;
        font-size: .78rem;
        font-weight: 950;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .kasir-title {
        margin: 0;
        color: #2f2117;
        font-size: clamp(1.8rem, 3vw, 2.75rem);
        font-weight: 950;
        line-height: 1;
    }

    .kasir-subtitle {
        margin: .45rem 0 0;
        color: #806d5f;
        font-weight: 650;
    }

    .kasir-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 2.75rem;
        padding: .75rem 1rem;
        border-radius: .85rem;
        background: linear-gradient(135deg, #6a3517, #3f210f);
        color: #fff8ed;
        font-size: .86rem;
        font-weight: 950;
        text-decoration: none;
        box-shadow: 0 14px 28px rgba(82, 42, 18, .18);
    }

    .kasir-action.light {
        border: 1px solid #ead8c4;
        background: #fffdf9;
        color: #633116;
        box-shadow: none;
    }

    .kasir-alert {
        margin-bottom: 1rem;
        padding: .85rem 1rem;
        border: 1px solid rgba(22, 101, 52, .18);
        border-radius: 1rem;
        background: #ecfdf3;
        color: #166534;
        font-weight: 850;
    }

    .kasir-card {
        overflow: hidden;
        border: 1px solid rgba(133, 91, 58, .16);
        border-radius: 1rem;
        background: rgba(255, 255, 255, .88);
        box-shadow: 0 18px 45px rgba(91, 54, 28, .1);
    }

    .kasir-form {
        display: grid;
        gap: 1rem;
        padding: 1rem;
    }

    .kasir-form-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: .85rem;
    }

    .kasir-field {
        display: grid;
        gap: .4rem;
    }

    .kasir-field.span-2 {
        grid-column: span 2;
    }

    .kasir-field.full {
        grid-column: 1 / -1;
    }

    .kasir-field label {
        color: #5f4b3d;
        font-size: .72rem;
        font-weight: 950;
        text-transform: uppercase;
    }

    .kasir-input,
    .kasir-select,
    .kasir-textarea {
        width: 100%;
        min-height: 2.65rem;
        padding: .65rem .75rem;
        border: 1px solid #ead8c4;
        border-radius: .85rem;
        background: #fffdf9;
        color: #2f2117;
        font: inherit;
        font-size: .88rem;
        font-weight: 750;
        outline: none;
    }

    .kasir-textarea {
        min-height: 5.5rem;
        resize: vertical;
    }

    .kasir-input:focus,
    .kasir-select:focus,
    .kasir-textarea:focus {
        border-color: #d8b996;
        box-shadow: 0 0 0 3px rgba(232, 154, 76, .16);
    }

    .kasir-form-actions,
    .kasir-row-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .55rem;
        align-items: center;
    }

    .kasir-row-actions {
        justify-content: flex-end;
    }

    .kasir-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 2.45rem;
        padding: .6rem .85rem;
        border: 0;
        border-radius: .75rem;
        background: linear-gradient(135deg, #6a3517, #3f210f);
        color: #fff8ed;
        cursor: pointer;
        font: inherit;
        font-size: .8rem;
        font-weight: 950;
        text-decoration: none;
    }

    .kasir-button.secondary {
        border: 1px solid #ead8c4;
        background: #fffdf9;
        color: #633116;
    }

    .kasir-button.danger {
        border: 1px solid #f3c6d0;
        background: #fff1f2;
        color: #be123c;
    }

    .kasir-inline-form {
        margin-top: .85rem;
        padding-top: .85rem;
        border-top: 1px solid rgba(133, 91, 58, .12);
    }

    .kasir-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem 1.15rem;
        border-bottom: 1px solid rgba(133, 91, 58, .12);
        background: linear-gradient(180deg, #fffdf9, #fff8ed);
    }

    .kasir-card-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 950;
    }

    .kasir-pill {
        display: inline-flex;
        align-items: center;
        padding: .35rem .65rem;
        border-radius: 999px;
        background: #f7ead9;
        color: #663214;
        font-size: .74rem;
        font-weight: 950;
        white-space: nowrap;
    }

    .kasir-table {
        width: 100%;
        border-collapse: collapse;
    }

    .kasir-table th {
        padding: .85rem 1rem;
        color: #79685c;
        font-size: .72rem;
        font-weight: 950;
        text-align: left;
        text-transform: uppercase;
        background: #fffaf3;
    }

    .kasir-table td {
        padding: .95rem 1rem;
        border-top: 1px solid rgba(133, 91, 58, .1);
        color: #3d2b1f;
        font-size: .88rem;
        font-weight: 700;
        vertical-align: middle;
    }

    .kasir-table tr:hover td {
        background: #fffaf3;
    }

    .kasir-muted {
        color: #8b7868;
        font-size: .8rem;
        font-weight: 650;
    }

    .kasir-status {
        display: inline-flex;
        padding: .35rem .6rem;
        border-radius: 999px;
        background: #ecfdf3;
        color: #166534;
        font-size: .73rem;
        font-weight: 950;
    }

    .kasir-status.warn {
        background: #fff7ed;
        color: #c2410c;
    }

    .kasir-status.danger {
        background: #fff1f2;
        color: #be123c;
    }

    .kasir-empty {
        padding: 3rem 1rem;
        color: #8b7868;
        text-align: center;
        font-weight: 800;
    }

    .kasir-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }

    .kasir-product {
        display: grid;
        gap: .75rem;
        padding: 1rem;
        border: 1px solid rgba(133, 91, 58, .14);
        border-radius: 1rem;
        background: #fffdf9;
    }

    .kasir-product-mark {
        display: grid;
        width: 2.7rem;
        height: 2.7rem;
        place-items: center;
        border-radius: .9rem;
        background: linear-gradient(135deg, #fff1d7, #e89a4c);
        color: #4b260f;
        font-weight: 950;
    }

    .kasir-product-name {
        margin: 0;
        min-height: 2.5rem;
        font-size: .94rem;
        font-weight: 950;
        line-height: 1.35;
    }

    .kasir-product-price {
        color: #633116;
        font-size: 1rem;
        font-weight: 950;
    }

    .pos-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 22rem;
        gap: 1rem;
    }

    .order-box {
        padding: 1rem;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(133, 91, 58, .14);
        font-size: 1.1rem;
        font-weight: 950;
    }

    @media (max-width: 1180px) {
        .kasir-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .kasir-form-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .pos-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .kasir-page {
            padding: 1rem;
        }

        .kasir-head {
            display: grid;
        }

        .kasir-grid {
            grid-template-columns: 1fr;
        }

        .kasir-form-grid {
            grid-template-columns: 1fr;
        }

        .kasir-field.span-2 {
            grid-column: auto;
        }

        .kasir-table {
            min-width: 680px;
        }

        .kasir-table-wrap {
            overflow-x: auto;
        }
    }
</style>
