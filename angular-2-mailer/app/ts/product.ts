export class Product {
    id: string;
    title: string;
    productCode: string;
    desc: string;
    
    constructor(id: string, title: string, productCode: string, desc: string){
        this.id = id;
        this.title = title;
        this.productCode = productCode;
        this.desc = desc;
    }
}