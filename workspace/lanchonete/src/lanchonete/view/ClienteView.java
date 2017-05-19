package lanchonete.view;

import java.util.List;

import lanchonete.model.ClienteDto;

public class ClienteView {
	
	public void listarCliente(List<ClienteDto> lista){
		System.out.println("---------------------------------------- Lista de Clientes -------------------------------------");
		if(!lista.isEmpty()){
			for(int i = 0; i < lista.size(); i++) {
				System.out.println("C�digo do cliente: "+lista.get(i).getCodigoCliente());
				System.out.println("C�digo do nome: "+lista.get(i).getNome());
				System.out.println("C�digo do telefone: "+lista.get(i).getTelefone());
				System.out.println("C�digo do CPF: "+lista.get(i).getCpf());
				System.out.println("C�digo do endere�o: "+lista.get(i).getEndereco());
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
