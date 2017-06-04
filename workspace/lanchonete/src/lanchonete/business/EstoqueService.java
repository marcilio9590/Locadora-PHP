package lanchonete.business;

import java.util.ArrayList;
import java.util.List;

import lanchonete.DAO.EstoqueDao;
import lanchonete.model.ProdutoModel;
import lanchonete.view.EstoqueView;

public class EstoqueService {
	/**
	 * 
	 * @param produtoCad
	 * @return
	 */
	public int salvarProduto(ProdutoModel produtoCad) {
		EstoqueDao dao = new EstoqueDao();
		int retorno = 0;
		try {
			retorno = dao.salvarProduto(produtoCad);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}

	/**
	 * listar produtos
	 */
	public void listarProdutos() {
		EstoqueDao dao = new EstoqueDao();
		try {
			List<ProdutoModel> lista = dao.listarProdutos();
			if (!lista.isEmpty()) {
				EstoqueView estoqueView = new EstoqueView();
				estoqueView.listarProdutos(lista);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * 
	 * @param codProduto
	 * @return
	 */
	public List<ProdutoModel> getProduto(int codProduto) {
		EstoqueDao dao = new EstoqueDao();
		List<ProdutoModel> lista = new ArrayList<>();
		try {
			ProdutoModel p = dao.getProduto(codProduto);
			if (p.getNome_produto() != null) {
				lista.add(p);
			}

		} catch (Exception e) {
			e.printStackTrace();
		}
		return lista;
	}

	/**
	 * 
	 * @param p
	 * @return
	 */
	public int editarProduto(ProdutoModel p) {
		EstoqueDao dao = new EstoqueDao();
		int retorno = 0;
		try {
			retorno = dao.updateProduto(p);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}

	/**
	 * 
	 * @param codProd
	 * @return
	 */
	public int excluirProduto(int codProd) {
		EstoqueDao dao = new EstoqueDao();
		int retorno = 0;
		try {
			retorno = dao.deletarProduto(codProd);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	/**
	 * 
	 * @param nivel
	 */
	public void checarNivelEstoque(int nivel){
		EstoqueDao dao = new EstoqueDao();
		try {
			List<ProdutoModel> lista = dao.checarNivelEstoque(nivel);
			if (!lista.isEmpty()) {
				EstoqueView estoqueView = new EstoqueView();
				estoqueView.listarProdutos(lista, "nivel estoque");
			}
		} catch (Exception e) {
			e.printStackTrace();
		}		
	}
	
	public void checarValidadeEstoque() throws Exception {
		EstoqueDao dao = new EstoqueDao();
		try {
			List<ProdutoModel> lista = dao.checarValidadeEstoque();
			if (!lista.isEmpty()) {
				EstoqueView estoqueView = new EstoqueView();
				estoqueView.listarProdutos(lista, "validade estoque");
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}







}
