package lanchonete.view;

import java.text.SimpleDateFormat;
import java.util.List;

import lanchonete.model.ProdutoModel;

public class EstoqueView {

	public void listarProdutos(List<ProdutoModel> lista) {
		System.out.println(
				"---------------------------------------- Lista de Produtos -------------------------------------");
		if (!lista.isEmpty()) {
			for (int i = 0; i < lista.size(); i++) {
				System.out.println("Código do produto: " + lista.get(i).getCod_produto());
				System.out.println("Nome do produto: " + lista.get(i).getNome_produto());
				System.out.println("Preço do produto: R$ " + lista.get(i).getPreco_produto());
				if(lista.get(i).getData_validade() != null){
					System.out.println("Data de validade: " + new SimpleDateFormat("MM/dd/yyyy").format(lista.get(i).getData_validade()));					
				}else{
					System.out.println("Data de validade: -");
				}
				System.out.println("Quantidade em estoque: " + lista.get(i).getQtd_disponivel());
				if (i != lista.size() - 1) {
					System.out.println(
							"------------------------------------------------------------------------------------------------");
				}
			}
		} else {
			System.out.println("Nenhum produto cadastrado.");
		}
		System.out.println(
				"------------------------------------------------------------------------------------------------");
	}
	
	public void listarProdutos(List<ProdutoModel> lista, String tipo) {
		if(tipo.equals("nivel estoque")){
			System.out.println(
					"---------------------------- Lista de produtos com estoque baixo -------------------------------");
			if (!lista.isEmpty()) {
				for (int i = 0; i < lista.size(); i++) {
					System.out.println("Código do produto: " + lista.get(i).getCod_produto());
					System.out.println("Nome do produto: " + lista.get(i).getNome_produto());
					System.out.println("Preço do produto: R$ " + lista.get(i).getPreco_produto());
					System.out.println("Data de vencimento: " + new SimpleDateFormat("dd/MM/yyyy").format(lista.get(i).getData_validade()));
					System.out.println("Quantidade em estoque: " + lista.get(i).getQtd_disponivel());
					if (i != lista.size() - 1) {
						System.out.println(
								"------------------------------------------------------------------------------------------------");
					}
				}
			}
		}else if(tipo.equals("validade estoque")){
			System.out.println(
					"------------------------ Lista de produtos a 10 dias do vencimento  ----------------------------");
			if (!lista.isEmpty()) {
				for (int i = 0; i < lista.size(); i++) {
					System.out.println("Código do produto: " + lista.get(i).getCod_produto());
					System.out.println("Nome do produto: " + lista.get(i).getNome_produto());
					System.out.println("Preço do produto: R$ " + lista.get(i).getPreco_produto());
					System.out.println("Data de vencimento: " + new SimpleDateFormat("dd/MM/yyyy").format(lista.get(i).getData_validade()));
					System.out.println("Quantidade em estoque: " + lista.get(i).getQtd_disponivel());
					if (i != lista.size() - 1) {
						System.out.println(
								"------------------------------------------------------------------------------------------------");
					}
				}
			}
		}
		if(lista.isEmpty()) {
			System.out.println("Nenhum produto cadastrado.");
		}
		System.out.println(
				"------------------------------------------------------------------------------------------------");
	}

}
