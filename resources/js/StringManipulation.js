import currency from "currency.js";

class StringManipulation {
    capitalize(string){
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    capitalizeLetter(string){
        let tempString = string.split(' ');
        let stringArr = []
        tempString.forEach(element => {
            stringArr.push(this.capitalize(element)); 
        });
        return stringArr.join(' ');
    }

    static rupiah(value){
        const format = currency(value, { 
            symbol: 'Rp. ', 
            decimal: '.', 
            separator: ',' ,
            precision: 0
        });
        return format.format();
    }
}

export default StringManipulation;
