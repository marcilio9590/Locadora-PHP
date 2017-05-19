package lanchonete.view;

import java.util.List;

import lanchonete.model.ClienteDto;

public class ClienteView {
	
	public void listarCliente(List<ClienteDto> lista){
		System.out.println("---------------------------------------- Lista de Clientes -------------------------------------");
		if(!lista.isEmpty()){
			for(int i = 0; i < lista.size(); i++) {
				System.out.println("Código do cliente: "+lista.get(i).getCodigoCliente());
				System.out.println("Código do nome: "+lista.get(i).getNome());
				System.out.println("Código do telefone: "+lista.get(i).getTelefone());
				System.out.println("Código do CPF: "+lista.get(i).getCpf());
				System.out.println("Código do endereço: "+lista.get(i).getEndereco());
				if(i != lista.size() - 1){
					System.out.println("------------------------------------------------------------------------------------------------");
				}
			}
		}else{
			System.out.println("Nenhum cliente cadastrado.");
		}
		System.out.println("------------------------------------------------------------------------------------------------");
	}
	
}
